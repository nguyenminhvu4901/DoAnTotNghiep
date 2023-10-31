<?php

use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\Frontend\Product\ProductController;
use App\Http\Controllers\Frontend\ProductDetail\ProductDetailController;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::group(['as' => 'productDetails.', 'prefix' => 'product-details', 'middleware' => ['auth']], function () {
    Route::get('index', [ProductDetailController::class, 'index'])->name('index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Product detail management'), route('frontend.productDetails.index'));
        });

    Route::get('{slug}/create', [ProductDetailController::class, 'create'])->name('create')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Product detail management'), route('frontend.productDetails.index'))
                ->push(__('Create new Option Product'));
        });

    Route::post('{id}/store', [ProductDetailController::class, 'store'])->name('store');

    Route::get('{slug}/{id}/edit', [ProductDetailController::class, 'edit'])->name('edit')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Product detail management'), route('frontend.productDetails.index'))
                ->push(__('Update Option Product'));
        });

    Route::put('{productId}/{productDetailId}/update', [ProductDetailController::class, 'update'])->name('update');

    Route::delete('{id}/destroy', [ProductDetailController::class, 'destroy'])->name('destroy');

    Route::get('trash', [ProductDetailController::class, 'getAllProductDetailInTrash'])->name('trash')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Product detail management'), route('frontend.productDetails.index'))
                ->push(__('Achieve Product Management'));
        });

    Route::get('{id}/restore', [ProductDetailController::class, 'restoreProductDetail'])->name('restore');

    Route::get('{id}/force-delete', [ProductDetailController::class, 'forceDeleteProductDetail'])->name('forceDelete');
});
