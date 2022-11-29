<?php

namespace App\Providers;

use App\Queries\RegistrationBox\RegistrationBoxSearchQuery;
use App\Queries\RegistrationBox\RegistrationBoxSearchQueryInterface;
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
        $this->app->singleton(RegistrationBoxSearchQueryInterface::class, RegistrationBoxSearchQuery::class);
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
