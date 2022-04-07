<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*',function ($view){
            $view->with('appName','E-Jastip');
            $view->with('sidebar',Config::get('sidebar')['user']);
            $view->with('ApiRajaOngkir',Config::get('api')['raja_ongkir']);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
