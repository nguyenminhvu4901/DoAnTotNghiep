<?php

use \App\Http\Controllers\Frontend\Staff\StaffController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::group(['as' => 'staff.', 'prefix' => 'staff', 'middleware' => ['auth', 'permission:user.management.staff', 'is_admin']], function () {
    Route::get('index', [StaffController::class, 'index'])->name('index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Staff management'), route('frontend.staff.index'));
        });
});
