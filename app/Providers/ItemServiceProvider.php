<?php

namespace App\Providers;

use App\Queries\ItemQueries\ItemQueries;
use App\Queries\ItemQueries\ItemQueriesInterface;
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
        $this->app->singleton(ItemQueriesInterface::class, ItemQueries::class);
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
