<?php

namespace App\Providers;

use App\Queries\AntenaQueries\AntennaQueries;
use App\Queries\AntenaQueries\AntennaQueriesInterface;
use App\Repositories\Antenna\AntennaRepository;
use App\Repositories\Antenna\AntennaRepositoryInterface;
use App\Services\Antena\AntenaService;
use App\Services\Antena\AntenaServiceInterface;
use Illuminate\Support\ServiceProvider;

class AntenaServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AntenaServiceInterface::class, AntenaService::class);
        $this->app->singleton(AntennaQueriesInterface::class, AntennaQueries::class);
        $this->app->singleton(AntennaRepositoryInterface::class, AntennaRepository::class);
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
