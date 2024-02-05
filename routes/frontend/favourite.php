<?php

use App\Http\Controllers\Frontend\Favourite\FavouriteController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::group(['as' => 'favourites.', 'prefix' => 'favourites', 'middleware' => ['auth']], function () {
    Route::get('index', [FavouriteController::class, 'index'])->name('index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Favourite Products'));
        });

    Route::post('add-to-favourite/{product_id}', [FavouriteController::class, 'addToFavourite'])->name('addToFavourite');
    Route::delete('delete-favourite-product/{product_id}', [FavouriteController::class, 'deleteFavourite'])->name('deleteFavourite');
});
