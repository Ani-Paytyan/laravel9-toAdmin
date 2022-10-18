<?php

namespace App\Providers;

use App\Services\Workplace\WorkplaceService;
use App\Services\Workplace\WorkplaceServiceInterface;
use Illuminate\Support\ServiceProvider;

class WorkplaceServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(WorkplaceServiceInterface::class, WorkplaceService::class);
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
