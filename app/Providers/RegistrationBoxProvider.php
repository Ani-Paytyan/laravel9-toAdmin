<?php

namespace App\Providers;

use App\Queries\RegistrationBox\RegistrationBoxQueries;
use App\Queries\RegistrationBox\RegistrationBoxQueriesInterface;
use App\Services\RegistrationBox\RegistrationBoxService;
use App\Services\RegistrationBox\RegistrationBoxServiceInterface;
use Illuminate\Support\ServiceProvider;

class RegistrationBoxProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RegistrationBoxServiceInterface::class, RegistrationBoxService::class);
        $this->app->singleton(RegistrationBoxQueriesInterface::class, RegistrationBoxQueries::class);
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
