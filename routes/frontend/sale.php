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
        })->middleware('permission:user.sale.view');

    Route::get('{productId}/{level}/create', [SaleController::class, 'create'])->name('create')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Sale management'), route('frontend.sales.index'))
                ->push(__('Create Product Discounts'));
        })->middleware('permission:user.sale.create');

    Route::post('{productId}/{level}/store', [SaleController::class, 'store'])->name('store')->middleware('permission:user.sale.create');

    Route::get('{id}/edit', [SaleController::class, 'edit'])->name('edit')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Sale management'), route('frontend.sales.index'))
                ->push(__('Update Product Discounts'));
        })->middleware('permission:user.sale.edit');

    Route::put('{id}/update', [SaleController::class, 'update'])->name('update')->middleware('permission:user.sale.edit');

    Route::patch('{saleId}/update-active', [SaleController::class, 'updateActive'])->name('updateActive')->middleware('permission:user.sale.edit');

    Route::delete('{saleId}/destroy', [SaleController::class, 'destroy'])->name('destroy')->middleware('permission:user.sale.disable');
});
