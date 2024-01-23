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
        })->middleware('permission:user.product.view');

    Route::get('{slug}/create', [ProductDetailController::class, 'create'])->name('create')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Product detail management'), route('frontend.productDetails.index'))
                ->push(__('Create new Option Product'));
        })->middleware('permission:user.product.create');

    Route::post('{id}/store', [ProductDetailController::class, 'store'])->name('store')->middleware('permission:user.product.create');

    Route::get('{slug}/{id}/edit', [ProductDetailController::class, 'edit'])->name('edit')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Product detail management'), route('frontend.productDetails.index'))
                ->push(__('Update Option Product'));
        })->middleware('permission:user.product.edit');

    Route::put('{productId}/{productDetailId}/update', [ProductDetailController::class, 'update'])->name('update')->middleware('permission:user.product.edit');

    Route::delete('{id}/destroy', [ProductDetailController::class, 'destroy'])->name('destroy')->middleware('permission:user.product.disable');

    Route::get('trash', [ProductDetailController::class, 'getAllProductDetailInTrash'])->name('trash')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Product detail management'), route('frontend.productDetails.index'))
                ->push(__('Achieve Product Management'));
        })->middleware('permission:user.product.trash');

    Route::get('{id}/restore', [ProductDetailController::class, 'restoreProductDetail'])->name('restore')->middleware('permission:user.product.trash');

    Route::get('{id}/force-delete', [ProductDetailController::class, 'forceDeleteProductDetail'])->name('forceDelete')->middleware('permission:user.product.trash');
});
