<?php

use App\Http\Controllers\Frontend\Product\ProductChartController;
use Illuminate\Support\Facades\Route;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::group(['as' => 'productChart.', 'prefix' => 'product-chart', 'middleware' => ['auth']], function () {
    Route::get('/detail', [ProductChartController::class, 'show'])->name('show');
    Route::get('/', [ProductChartController::class, 'index'])->name('index');
});
