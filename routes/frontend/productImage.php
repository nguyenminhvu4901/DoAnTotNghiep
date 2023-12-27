<?php

use App\Http\Controllers\Frontend\ProductImage\ProductImageController;
use Tabuna\Breadcrumbs\Trail;


/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::group(['as' => 'productImages.', 'prefix' => 'product-images', 'middleware' => ['auth']], function () {
    Route::get('index', [ProductImageController::class, 'index'])->name('index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Product image management'), route('frontend.productImages.index'));
        })->middleware('permission:user.product.view');

    Route::get('{slug}/create', [ProductImageController::class, 'create'])->name('create')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Product image management'), route('frontend.productImages.index'))
                ->push(__('Create new Option Product'));
        })->middleware('permission:user.product.create');

    Route::post('{id}/store', [ProductImageController::class, 'store'])->name('store')->middleware('permission:user.product.create');

    Route::get('{slug}/{id}/edit', [ProductImageController::class, 'edit'])->name('edit')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Product image management'), route('frontend.productImages.index'))
                ->push(__('Update Option Product'));
        })->middleware('permission:user.product.edit');

    Route::put('{productId}/{productImageId}/update', [ProductImageController::class, 'update'])->name('update')->middleware('permission:user.product.edit');

    Route::delete('{productImageId}/destroy', [ProductImageController::class, 'destroy'])->name('destroy')->middleware('permission:user.product.disable');

    Route::get('trash', [ProductImageController::class, 'getAllProductImageInTrash'])->name('trash')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Product image management'), route('frontend.productImages.index'))
                ->push(__('Achieve Product Management'));
        })->middleware('permission:user.product.trash');

    Route::get('{id}/restore', [ProductImageController::class, 'restoreProductImage'])->name('restore')->middleware('permission:user.product.trash');

    Route::get('{id}/force-delete', [ProductImageController::class, 'forceDeleteProductImage'])->name('forceDelete')->middleware('permission:user.product.trash');
});
