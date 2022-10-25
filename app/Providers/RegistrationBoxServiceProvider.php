<?php

namespace App\Providers;

use App\Services\RegistrationBox\RegistrationBoxService;
use App\Services\RegistrationBox\RegistrationBoxServiceInterface;
use Illuminate\Support\ServiceProvider;

class RegistrationBoxServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RegistrationBoxServiceInterface::class, RegistrationBoxService::class);
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
