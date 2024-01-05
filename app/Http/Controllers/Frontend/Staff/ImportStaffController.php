<?php

namespace App\Http\Controllers\Frontend\Staff;

use App\Domains\Staff\Services\StaffService;
use App\Http\Controllers\Controller;

class ImportStaffController extends Controller
{
    protected StaffService $staffService;

    public function __construct(
        StaffService $staffService
    )
    {
        $this->staffService = $staffService;
    }

    public function importStaff()
    {
        return view('frontend.pages.staff.import.index');
    }

}
