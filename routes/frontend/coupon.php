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
        });

    Route::get('create', [CouponController::class, 'create'])->name('create')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Coupon management'), route('frontend.coupons.index'))
                ->push(__('Create new coupon'));
        });

    Route::post('store', [CouponController::class, 'store'])->name('store');

    Route::get('{slug}/edit', [CouponController::class, 'edit'])->name('edit')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Coupon management'), route('frontend.coupons.index'))
                ->push(__('Update coupon'));
        });

    Route::get('{slug}/detail', [CouponController::class, 'detail'])->name('detail')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Coupon management'), route('frontend.coupons.index'))
                ->push(__('Coupon Information'));
        });

    Route::put('{slug}/update', [CouponController::class, 'update'])->name('update');

    Route::delete('{slug}/destroy', [CouponController::class, 'destroy'])->name('destroy');
});
