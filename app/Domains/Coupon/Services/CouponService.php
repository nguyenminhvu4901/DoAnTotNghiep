<?php

namespace App\Domains\Coupon\Services;

use Exception;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Domains\Coupon\Models\Coupon;

/**
 * Class CategoryService.
 */
class CouponService extends BaseService
{
    protected Coupon $coupon;
    /**
     * ProductService constructor.
     * @param Coupon $coupon
     */
    public function __construct(
        Coupon $coupon
    ) {
        $this->model = $coupon;
    }

    public function getLatestCategory()
    {
        return $this->model::latest()->first();
    }

    public function search(array $data = [])
    {
        return $this->model->search($this->escapeSpecialCharacter($data['search'] ?? ''))
            ->latest('id')
            ->paginate(config('constants.paginate'));
    }

    public function searchWithTrash(array $data = [])
    {
        return $this->model->search($this->escapeSpecialCharacter($data['search'] ?? ''))
            ->when(isset($data['categories']), function ($query) use ($data) {
                $query->filterByCategories($data['categories']);
            })
            ->with('categories', 'productDetail')
            ->onlyTrashed()
            ->latest('id')
            ->paginate(config('constants.paginate'));
    }

    public function create(array $data = []): Coupon
    {
        DB::beginTransaction();
        try {
            $product = $this->model->create([
                'name' => $data['name'],
                'type' => $data['type'],
                'value' => $data['value'],
                'start_date' => $data['start_date'],
                'expiry_date' => $data['expiry_date'],
                'quantity' => $data['quantity'],
                'description' => $data['description']
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating product. Please try again.'));
        }

        return $product;
    }

    public function update(Coupon $coupon, array $data = []): Coupon
    {
        DB::beginTransaction();
        try {
            $coupon->update([
                'name' => $data['name'],
                'type' => $data['type'],
                'value' => $data['value'],
                'start_date' => $data['start_date'],
                'expiry_date' => $data['expiry_date'],
                'quantity' => $data['quantity'],
                'description' => $data['description']
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating product. Please try again.'));
        }

        return $coupon;
    }

    public function delete(Coupon $coupon): Coupon
    {
        DB::beginTransaction();
        try {
            $coupon->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem delete product. Please try again.'));
        }

        return $coupon;
    }

    public function getAllProducts()
    {
        return $this->model->all();
    }
}
