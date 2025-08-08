<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
        \App\Repositories\Interface\TodoInterface\TodoRepositoryInterface::class,
        \App\Repositories\Eloquent\TodoRepository\TodoRepository::class,
        );
        
        $this->app->bind(
        \App\Repositories\Interface\TodoGroupInterface\TodoGroupRepositoryInterface::class,
        \App\Repositories\Eloquent\TodoGroupRepository\TodoGroupRepository::class,
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
