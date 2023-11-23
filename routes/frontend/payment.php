<?php

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

use App\Http\Controllers\PaymentController;

Route::get('/payment/{type}', [PaymentController::class, 'payment'])
    ->name('payment');
