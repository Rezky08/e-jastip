<?php

namespace App\Providers;

use App\Supports\Repositories\AuthRepository;
use App\Supports\Repositories\PartnerRepository;
use App\Supports\Repositories\TransactionRepository;
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
            return new AuthRepository(fn() => $app->make(Request::class));
        });
        $this->app->singleton(TransactionRepository::class, function () {
            return new TransactionRepository();
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
