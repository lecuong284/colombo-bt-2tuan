<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Contracts\Repositories\GroupMenuRepository::class, \App\Repositories\Eloquent\GroupMenuRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\MenuRepository::class, \App\Repositories\Eloquent\MenuRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\CateFoodRepository::class, \App\Repositories\Eloquent\CateFoodRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\FoodRepository::class, \App\Repositories\Eloquent\FoodRepositoryEloquent::class);
        //:end-bindings:
    }
}
