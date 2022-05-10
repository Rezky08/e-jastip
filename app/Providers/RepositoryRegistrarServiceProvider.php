<?php

namespace App\Providers;

use App\Supports\Repositories\AuthRepository;
use App\Supports\Repositories\PartnerRepository;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class RepositoryRegistrarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AuthRepository::class, function (Application $app) {
            return new AuthRepository(fn () => $app->make(Request::class));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
