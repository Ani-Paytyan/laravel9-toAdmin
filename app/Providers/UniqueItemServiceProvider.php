<?php

namespace App\Providers;

use App\Services\UniqueItem\UniqueItemService;
use App\Services\UniqueItem\UniqueItemServiceInterface;
use Illuminate\Support\ServiceProvider;

class UniqueItemServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UniqueItemServiceInterface::class, UniqueItemService::class);
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
