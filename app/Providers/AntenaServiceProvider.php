<?php

namespace App\Providers;

use App\Services\Antena\AntenaServiceInterface;
use App\Services\Antena\AntenaService;
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
