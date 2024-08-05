<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoriesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Business\ICategoryRepository::class, \App\Repositories\EloquentCategoryRepository::class);
        $this->app->bind(\App\Business\IProductRepository::class, \App\Repositories\EloquentProductRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
