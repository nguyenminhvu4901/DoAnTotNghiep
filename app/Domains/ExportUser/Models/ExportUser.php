<?php

namespace App\Domains\ExportUser\Models;

use App\Domains\Staff\Models\Staff;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportUser implements FromView
{
    public function view(): View
    {
        return view('frontend.pages.staff.export.export-staff', [
            'staff' => Staff::all()
        ]);
    }
}
