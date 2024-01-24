<?php

namespace App\Http\Controllers\Frontend\Staff;

use App\Domains\Auth\Services\UserService;
use App\Domains\ImportUser\Models\ImportUser;
use App\Domains\Staff\Services\StaffService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Staff\ImportStaffRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

class ImportStaffController extends Controller
{
    protected StaffService $staffService;
    protected UserService $userService;

    public function __construct(
        StaffService $staffService,
        UserService $userService
    )
    {
        $this->staffService = $staffService;
        $this->userService = $userService;
    }

    public function importStaff()
    {
        return view('frontend.pages.staff.import.index');
    }

    public function store(ImportStaffRequest $request)
    {
        $import = new ImportUser();
        Excel::import($import, $request->file('file-staff'));
        if ($import->getListDataError()) {
            $dataError = implode(', ', array_unique($import->getListDataError()));
            return back()->withFlashDanger(__('Emails :data are duplicated in excel file or already have this email in the system', ['data' => $dataError]));
        }

        return redirect(route('frontend.staff.index'))
            ->withFlashSuccess(__('Import success'));
    }

    public function downloadTemplate()
    {
        $filepath = public_path('files/staff/staff.xlsx');
        return Response::download($filepath);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function checkStaffEmailExists(Request $request): JsonResponse
    {
        $params = $request->all();
        $emails = array_key_exists('checkEmails', $params) ? $params['checkEmails'] : [];
        $userExists = $this->userService->getActiveUsersByEmails($emails);

        return response()->json(
            [
                'status' => 'success',
                'data' => $userExists->pluck('email')->toArray(),
            ]
        );
    }

}
