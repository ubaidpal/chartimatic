<?php

namespace Cartimatic\Shop;

use Illuminate\Support\ServiceProvider;

class ShopServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__.'/Http/routes.php';
        //Define the path of views folder
        $this->loadViewsFrom(__DIR__ . '/Views', 'Shop');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app['Shop'] = $this->app->share(function ($app) {
            return new Shop;
        });

    }
}
