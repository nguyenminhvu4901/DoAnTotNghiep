<?php

use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\Frontend\Category\CategoryController;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('categories/index', [CategoryController::class, 'index'])->name('categories.index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent(homeRoute())
            ->push(__('Category management'), route('frontend.categories.index'));
    });

Route::group(['as' => 'categories.', 'prefix' => 'categories', 'middleware' => ['auth']], function () {
    Route::get('create', [CategoryController::class, 'create'])->name('create')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Category management'), route('frontend.categories.index'))
                ->push(__('Create new Category'));
        })->middleware('permission:user.category.create');

    Route::post('store', [CategoryController::class, 'store'])->name('store')->middleware('permission:user.category.create');

    Route::get('{categorySlug}/edit', [CategoryController::class, 'edit'])->name('edit')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Category management'), route('frontend.categories.index'))
                ->push(__('Update Category'));
        })->middleware('permission:user.category.edit');

    Route::put('{slug}/update', [CategoryController::class, 'update'])->name('update')->middleware('permission:user.category.edit');

    Route::delete('{id}/destroy', [CategoryController::class, 'destroy'])->name('destroy')->middleware('permission:user.category.disable');

    Route::get('trash', [CategoryController::class, 'getAllCategoryInTrash'])->name('trash')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Category management'), route('frontend.categories.index'))
                ->push(__('Achieve Category management'));
        })->middleware('permission:user.category.trash');

    Route::get('{id}/restore', [CategoryController::class, 'restoreCategory'])->name('restore')->middleware('permission:user.category.trash');

    Route::get('{id}/force-delete', [CategoryController::class, 'forceDeleteCategory'])->name('forceDelete')->middleware('permission:user.category.trash');
});
