<?php

use \App\Http\Controllers\Frontend\Staff\StaffController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::group(['as' => 'customer.', 'prefix' => 'customer', 'middleware' => ['auth', 'permission:user.management.staff', 'is_admin']], function () {
    Route::get('index')->name('index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Customer management'), route('frontend.customer.index'));
        });
});
