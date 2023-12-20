<?php

use App\Http\Controllers\Frontend\Cart\CartController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::group(['as' => 'carts.', 'prefix' => 'carts', 'middleware' => ['auth']], function () {
    Route::get('index', [CartController::class, 'index'])->name('index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Cart management'), route('frontend.carts.index'));
        });

    Route::post('{userId}/add-to-cart', [CartController::class, 'addToCart'])->name('addToCart');

    Route::put('{productDetailId}/{cartId}/update-product-in-cart', [CartController::class, 'updateProductInCart'])->name('updateProductInCart');

    Route::delete('{productDetailId}/{cartId}/delete-product-from-cart', [CartController::class, 'deleteProductFromCart'])->name('deleteProductFromCart');

    Route::post('/apply-coupon', [CartController::class, 'applyCoupon'])->name('applyCoupon');
});
