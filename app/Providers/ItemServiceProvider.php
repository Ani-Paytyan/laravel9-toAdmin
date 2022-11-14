<?php

namespace App\Providers;

use App\Services\Item\ItemService;
use App\Services\Item\ItemServiceInterface;
use Illuminate\Support\ServiceProvider;

class ItemServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ItemServiceInterface::class, ItemService::class);
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
