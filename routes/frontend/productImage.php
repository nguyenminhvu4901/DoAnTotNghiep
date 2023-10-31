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
        });

    Route::get('{slug}/create', [ProductImageController::class, 'create'])->name('create')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Product image management'), route('frontend.productImages.index'))
                ->push(__('Create new Option Product'));
        });

    Route::post('{id}/store', [ProductImageController::class, 'store'])->name('store');

    Route::get('{slug}/{id}/edit', [ProductImageController::class, 'edit'])->name('edit')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Product image management'), route('frontend.productImages.index'))
                ->push(__('Update Option Product'));
        });

    Route::put('{productId}/{productImageId}/update', [ProductImageController::class, 'update'])->name('update');

    Route::delete('{productImageId}/destroy', [ProductImageController::class, 'destroy'])->name('destroy');

    Route::get('trash', [ProductImageController::class, 'getAllProductImageInTrash'])->name('trash')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Product image management'), route('frontend.productImages.index'))
                ->push(__('Achieve Product Management'));
        });

    Route::get('{id}/restore', [ProductImageController::class, 'restoreProductImage'])->name('restore');

    Route::get('{id}/force-delete', [ProductImageController::class, 'forceDeleteProductImage'])->name('forceDelete');
});
