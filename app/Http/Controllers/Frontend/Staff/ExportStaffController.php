<?php

namespace App\Http\Controllers\Frontend\Staff;

use App\Domains\ExportUser\Models\ExportUser;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportStaffController extends Controller
{
    public function exportStaff()
    {
        return Excel::download(new ExportUser(), 'staff-list.xlsx');
    }
}
