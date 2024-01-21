<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Auth;

/**
 * Class HomeController.
 */
class HomeController
{
    public function index()
    {
        return redirect()->route('frontend.user.dashboard');
        // if (Auth::check()) {
        //     return redirect()->route('frontend.user.dashboard');
        // } else {
        //     return view('frontend.index');
        // }
    }
}
