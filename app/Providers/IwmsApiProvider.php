<?php

namespace App\Providers;

use App\Services\IwmsApi\Auth\IwmsApiAuthService;
use App\Services\IwmsApi\Auth\IwmsApiAuthServiceInterface;
use App\Services\IwmsApi\Workplace\IwmsApiWorkplaceService;
use App\Services\IwmsApi\Workplace\IwmsApiWorkplaceServiceInterface;
use Illuminate\Support\ServiceProvider;

class IwmsApiProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(IwmsApiAuthServiceInterface::class, IwmsApiAuthService::class);
        $this->app->singleton(IwmsApiWorkplaceServiceInterface::class, IwmsApiWorkplaceService::class);
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
