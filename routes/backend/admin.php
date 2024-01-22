<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\ChatController;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);

Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'));
        });

    Route::prefix('chat')->group(function () {
        Route::controller(ChatController::class)->as('chat.')->group(function () {
            Route::get('/', 'index')->name('index');
        });
    });
});
