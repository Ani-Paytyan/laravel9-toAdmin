<?php

namespace App\Providers;

use App\Services\AntenaWorkplace\AntenaWorkplaceService;
use App\Services\AntenaWorkplace\AntenaWorkplaceServiceInterface;
use Illuminate\Support\ServiceProvider;

class AntenaWorkplaceServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AntenaWorkplaceServiceInterface::class, AntenaWorkplaceService::class);
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
