<?php

namespace App\Providers;

use App\Services\WatcherApi\WatcherAntenna\WatcherAntennaApiService;
use App\Services\WatcherApi\WatcherAntenna\WatcherAntennaApiServiceInterface;
use Illuminate\Support\ServiceProvider;

class WatcherProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(WatcherAntennaApiServiceInterface::class, WatcherAntennaApiService::class);
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
