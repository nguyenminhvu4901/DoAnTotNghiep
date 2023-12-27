<?php

use App\Http\Controllers\Frontend\Coupon\CouponController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::group(['as' => 'coupons.', 'prefix' => 'coupons', 'middleware' => ['auth']], function () {
    Route::get('index', [CouponController::class, 'index'])->name('index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Coupon management'), route('frontend.coupons.index'));
        })->middleware('permission:user.coupon.view');

    Route::get('create', [CouponController::class, 'create'])->name('create')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Coupon management'), route('frontend.coupons.index'))
                ->push(__('Create new coupon'));
        })->middleware('permission:user.coupon.create');

    Route::post('store', [CouponController::class, 'store'])->name('store')->middleware('permission:user.coupon.store');

    Route::get('{slug}/edit', [CouponController::class, 'edit'])->name('edit')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Coupon management'), route('frontend.coupons.index'))
                ->push(__('Update coupon'));
        })->middleware('permission:user.coupon.edit');

    Route::get('{slug}/detail', [CouponController::class, 'detail'])->name('detail')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Coupon management'), route('frontend.coupons.index'))
                ->push(__('Coupon Information'));
        })->middleware('permission:user.coupon.detail');

    Route::put('{slug}/update', [CouponController::class, 'update'])->name('update')->middleware('permission:user.coupon.edit');

    Route::delete('{slug}/destroy', [CouponController::class, 'destroy'])->name('destroy')->middleware('permission:user.coupon.disable');
});
