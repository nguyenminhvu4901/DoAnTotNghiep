<?php

use \App\Http\Controllers\Frontend\User\DashboardController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::group(['as' => 'dashboard.', 'prefix' => 'dashboard'], function () {
    //Products
    Route::group(['as' => 'products.', 'prefix' => 'products'], function () {
        Route::get('index', [DashboardController::class, 'indexProduct'])->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent(homeRoute())
                    ->push(__('List Of Product'), route('frontend.dashboard.products.index'));
            });

        Route::get('{id}/detail', [DashboardController::class, 'detailProduct'])->name('detail')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent(homeRoute())
                    ->push(__('List Of Product'), route('frontend.dashboard.products.index'))
                    ->push(__('Product Information'));
            });
    });

    //Coupon
    Route::group(['as' => 'coupons.', 'prefix' => 'coupons'], function () {
        Route::get('index', [DashboardController::class, 'indexCoupon'])->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent(homeRoute())
                    ->push(__('List Of Coupon'), route('frontend.dashboard.coupons.index'));
            });

        Route::get('{slug}/detail', [DashboardController::class, 'detailCoupon'])->name('detail')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent(homeRoute())
                    ->push(__('List Of Coupon'), route('frontend.dashboard.coupons.index'))
                    ->push(__('Coupon Information'));
            });
    });

    //Sale
    Route::group(['as' => 'sales.', 'prefix' => 'sales'], function () {
        Route::get('index', [DashboardController::class, 'indexSale'])->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent(homeRoute())
                    ->push(__('List Of Sale Product'), route('frontend.dashboard.sales.index'));
            });
    });
});

