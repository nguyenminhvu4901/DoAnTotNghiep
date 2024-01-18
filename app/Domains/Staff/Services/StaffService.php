<?php

namespace App\Domains\Staff\Services;

use App\Domains\Auth\Events\User\UserUpdated;
use App\Domains\Auth\Models\User;
use App\Domains\Auth\Services\UserService;
use App\Domains\Staff\Models\Staff;
use Exception;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Domains\Product\Models\Product;

/**
 * Class CategoryService.
 */
class StaffService extends BaseService
{
    protected UserService $userService;

    public function __construct(
        Staff       $staff,
        UserService $userService
    )
    {
        $this->model = $staff;
        $this->userService = $userService;
    }

    public function search($data)
    {
        return $this->model->withNameOrEmail($this->escapeSpecialCharacter($data['search'] ?? ''))
            ->with('user')
            ->latest('id')->paginate(config('constants.paginate'));
    }

    public function searchWithTrash($data)
    {
        return $this->model->withNameOrEmailIncludingTrash($this->escapeSpecialCharacter($data['search'] ?? ''))
            ->onlyTrashed()
            ->latest('id')->paginate(config('constants.paginate'));
    }

    public function store(array $data = [])
    {
        DB::beginTransaction();
        try {
            $staff = $this->createStaff($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating staff. Please try again.'));
        }

        return $staff;
    }

    /**
     * @param array $data
     * @return Staff
     * @throws GeneralException
     */
    protected function createStaff(array $data = []): Staff
    {
        try {
            $user = $this->userService->registerUserWithoutTryCatch($data);
            $user->assignRole(User::ROLE_STAFF);
        } catch (Exception $e) {
            throw new GeneralException(__('There was a problem creating new user for this assistant'));
        }

        return $this->model->create([
            'user_id' => $user->id,
            'gender' => $data['gender'],
            'birthday' => $data['birthday'],
            'phone' => $data['phone'],
            'bio' => $data['bio'] ?? '',
        ]);
    }

    public function update(array $data = [], Staff|Model $staff)
    {
        DB::beginTransaction();
        try {
            $staff = $this->updateStaff($data, $staff);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating staff. Please try again.'));
        }

        return $staff;
    }

    protected function updateStaff(array $updateData = [], Staff|Model $staff): Staff
    {
        DB::beginTransaction();
        try {
            try {
                $this->userService->updateUserFromMemberData($staff->user, $updateData);
            } catch (Exception $e) {
                throw new GeneralException(
                    __("There was a problem updating assistant's corresponding user. Please try again.")
                );
            }

            $staff->update([
                'gender' => $updateData['gender'],
                'birthday' => $updateData['birthday'],
                'phone' => $updateData['phone'],
                'bio' => $updateData['bio'],
            ]);
            event(new UserUpdated($staff->user));

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this assistant. Please try again.'));
        }

        return $staff;
    }

    public function delete(Staff|Model $staff)
    {
        DB::beginTransaction();
        try {
            $staff->user->delete();
            event(new UserUpdated($staff->user));
            $staff->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem deleting staff. Please try again.'));
        }

        return $staff;
    }

    public function restore(Staff|Model $staff): Staff
    {
        DB::beginTransaction();
        try {
            $staff->userWithTrashed->restore();
            $staff->restore();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem restore staff. Please try again.'));
        }

        return $staff;
    }

    public function forceDelete(Staff|Model $staff): Staff
    {
        DB::beginTransaction();
        try {
            $staff->userWithTrashed->forceDelete();
            $staff->forceDelete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem when deleting staff. Please try again.'));
        }

        return $staff;
    }

}
