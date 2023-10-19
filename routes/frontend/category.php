<?php

use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\Frontend\Category\CategoryController;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::group(['as' => 'categories.', 'prefix' => 'categories',], function () {
    Route::get('index', [CategoryController::class, 'index'])->name('index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Category management'), route('frontend.categories.index'));
        });

    Route::get('create', [CategoryController::class, 'create'])->name('create')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Category management'), route('frontend.categories.index'))
                ->push(__('Create new Category'));
        });

    Route::post('store', [CategoryController::class, 'store'])->name('store');

    Route::get('{categorySlug}/edit', [CategoryController::class, 'edit'])->name('edit')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Category management'), route('frontend.categories.index'))
                ->push(__('Update Category'));
        });

    Route::put('{slug}/update', [CategoryController::class, 'update'])->name('update');

    Route::delete('{categorySlug}/destroy', [CategoryController::class, 'destroy'])->name('destroy');
});
