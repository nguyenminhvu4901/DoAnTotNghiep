<?php

use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\Frontend\Product\ProductController;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::group(['as' => 'products.', 'prefix' => 'products', 'middleware' => ['auth']], function () {
    Route::get('index', [ProductController::class, 'index'])->name('index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Product management'), route('frontend.products.index'));
        })->middleware('permission:user.product.view');

    Route::get('create', [ProductController::class, 'create'])->name('create')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Product management'), route('frontend.products.index'))
                ->push(__('Create new Product'));
        })->middleware('permission:user.product.create');

    Route::post('store', [ProductController::class, 'store'])->name('store')->middleware('permission:user.product.create');

    Route::get('{slug}/edit', [ProductController::class, 'edit'])->name('edit')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Product management'), route('frontend.products.index'))
                ->push(__('Update Product'));
        })->middleware('permission:user.product.edit');

    Route::get('{id}/detail', [ProductController::class, 'detail'])->name('detail')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Product management'), route('frontend.products.index'))
                ->push(__('Product Information'));
        })->middleware('permission:user.product.detail');

    Route::put('{slug}/update', [ProductController::class, 'update'])->name('update')->middleware('permission:user.product.edit');

    Route::delete('{id}/destroy', [ProductController::class, 'destroy'])->name('destroy')->middleware('permission:user.product.disable');

    Route::get('trash', [ProductController::class, 'getAllProductInTrash'])->name('trash')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Product management'), route('frontend.products.index'))
                ->push(__('Achieve Product Management'));
        })->middleware('permission:user.product.trash');

    Route::get('{id}/restore', [ProductController::class, 'restoreProduct'])->name('restore')->middleware('permission:user.product.trash');

    Route::get('{id}/force-delete', [ProductController::class, 'forceDeleteProduct'])->name('forceDelete')->middleware('permission:user.product.trash');
});
