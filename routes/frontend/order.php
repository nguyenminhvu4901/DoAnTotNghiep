<?php

use App\Http\Controllers\Frontend\Order\OrderController;
use App\Http\Controllers\Frontend\Sale\SaleController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::group(['as' => 'orders.', 'prefix' => 'orders', 'middleware' => ['auth']], function () {
    Route::get('index', [OrderController::class, 'index'])->name('index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Sale management'), route('frontend.sales.index'));
        });

    Route::post('checkout', [OrderController::class, 'checkout'])->name('checkout')->middleware('cart_not_empty');
});
