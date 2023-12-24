<?php

use App\Http\Controllers\Frontend\Order\OrderController;
use App\Http\Controllers\Frontend\Sale\SaleController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::group(['as' => 'orders.', 'prefix' => 'orders', 'middleware' => ['auth', 'web', 'permission:user.order']], function () {

    Route::patch('update-status-order/{orderId}', [OrderController::class, 'updateStatusOrder'])->name('updateStatusOrder');

    Route::patch('cancel-order/{orderId}', [OrderController::class, 'cancelOrder'])->name('cancelOrder');

    Route::get('index', [OrderController::class, 'index'])->name('index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Order management'), route('frontend.orders.index'));
        });

    Route::get('index/customer-information/{orderId}', [OrderController::class, 'getCustomerInformation'])->name('customerInfo')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Order management'), route('frontend.orders.index'))
                ->push(__('Customer Information In Order'));
        });

    Route::get('index/product-information/{orderId}', [OrderController::class, 'getProductInformation'])->name('productInfo')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Order management'), route('frontend.orders.index'))
                ->push(__('Product Information In Order'));
        });

    Route::post('process-checkout', [OrderController::class, 'processCheckout'])->name('processCheckout');

    Route::get('checkout', [OrderController::class, 'checkout'])->name('checkout')->middleware('cart_not_empty');

    Route::get('get-district-detail/{provinceID}', [OrderController::class, 'getDistrictDetailByProvinceId'])->name('getDistrictDetail');

    Route::get('get-province-in-viet-nam', [OrderController::class, 'getProvinceInVietNam'])->name('getProvinceInVietNam');

    Route::get('get-ward-detail/{districtID}', [OrderController::class, 'getWardDetailByDistrictId'])->name('getWardDetail');

    Route::get('delivery-fee-charged/{districtID}/{wardCode}', [OrderController::class, 'getShippingCostDetail'])->name('getShippingCost');

    Route::get('vnpay-thanks', [OrderController::class, 'getVNPayThanks'])->name('getVNPayThanks');

    Route::get('wait-payment', [OrderController::class, 'getWaitPayment'])->name('getWaitPayment')->middleware(['prevent_direct_access']);

    Route::post('vnpay-payment', [OrderController::class, 'processCheckoutWhenPayingWithVnpay'])->name('processCheckoutWhenPayingWithVnpay');
});
