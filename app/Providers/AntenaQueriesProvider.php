<?php

namespace App\Providers;

use App\Queries\AntennaQueries;
use App\Queries\AntennaQueriesInterface;
use Illuminate\Support\ServiceProvider;

class AntenaQueriesProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AntennaQueriesInterface::class, AntennaQueries::class);
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
