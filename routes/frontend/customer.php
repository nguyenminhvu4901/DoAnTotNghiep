<?php

use \App\Http\Controllers\Frontend\Customer\CustomerController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::group(['as' => 'customers.', 'prefix' => 'customers', 'middleware' => ['auth', 'permission:user.management.customer', 'is_admin']], function () {
    Route::get('index', [CustomerController::class, 'index'])->name('index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Customer management'), route('frontend.customers.index'));
        });

    Route::get('create', [CustomerController::class, 'create'])->name('create')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Customer management'), route('frontend.customers.index'))
                ->push(__('Create New Customer'));
        });

    Route::post('', [CustomerController::class, 'store'])
        ->name('store');

    Route::get('{id}/show', [CustomerController::class, 'show'])->name('show')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Customer management'), route('frontend.customers.index'))
                ->push(__('Customer Information'));
        });

    Route::get('{id}/edit', [CustomerController::class, 'edit'])->name('edit')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Customer management'), route('frontend.customers.index'))
                ->push(__('Edit Customer Information'));
        });

    Route::put('{id}/update', [CustomerController::class, 'update'])->name('update');

    Route::delete('{id}/destroy', [CustomerController::class, 'destroy'])->name('destroy');

    Route::get('trash', [CustomerController::class, 'getAllCustomerInTrash'])->name('trash')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Customer management'), route('frontend.customers.index'))
                ->push(__('Customer Information in trash'));
        });

    Route::get('{id}/restore', [CustomerController::class, 'restoreCustomer'])->name('restore');

    Route::get('{id}/force-delete', [CustomerController::class, 'forceDeleteCustomer'])->name('forceDelete');

});
