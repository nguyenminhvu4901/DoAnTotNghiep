<?php

use App\Http\Controllers\Frontend\Cart\CartController;
use App\Http\Controllers\Frontend\Sale\SaleController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::group(['as' => 'sales.', 'prefix' => 'sales', 'middleware' => ['auth']], function () {
    Route::get('index', [SaleController::class, 'index'])->name('index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Sale management'), route('frontend.sales.index'));
        });

    Route::get('{productId}/create', [SaleController::class, 'create'])->name('create')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Sale management'), route('frontend.sales.index'))
                ->push(__('Create Product Discounts'));
        });

    Route::post('{productId}/{level}/store', [SaleController::class, 'store'])->name('store');
});
