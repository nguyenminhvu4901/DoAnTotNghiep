<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider.
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        //@hasPermission('delete_product')
        //@hasPermission(['delete_product', 'edit_product'])
        Blade::if('hasPermission', function ($permissions) {
            $user = auth()->user();
            if (!$user) {
                return false;
            }

            $permissions = is_array($permissions) ? $permissions : explode('|', $permissions);

            foreach ($permissions as $permission) {
                if ($user->can($permission)) {
                    return true;
                }
            }

            return false;
        });
    }
}
