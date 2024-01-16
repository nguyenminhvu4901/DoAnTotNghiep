<?php

use App\Http\Controllers\Frontend\Product\ProductChartController;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::group(['as' => 'productChart.', 'prefix' => 'product-chart', 'middleware' => ['auth', 'permission:user.product.create']], function () {
    Route::get('/detail', [ProductChartController::class, 'show'])->name('show')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Statistic'));
        });

    Route::get('/', [ProductChartController::class, 'index'])->name('index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Statistic'));
        });
});
