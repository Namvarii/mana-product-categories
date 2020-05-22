<?php

namespace ManaCMS\ManaProductCategories;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

/**
 * Class    RouteServiceProvider
 *
 * @author  Mahdi Namvarii <mahdi@namvarii.ir>
 * @since   2019-08-21
 *
 * @package ManaCMS\ManaCategories
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        # Loads
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
//        $this->loadFactoriesFrom(__DIR__.'/../database/factories');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'ProductCategories');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'ProductCategories');

        # Publishes
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/admin/mana-product-categories'),
        ], 'ProductCategories');

        /*$this->publishes([
            __DIR__.'/../public' => public_path('vendor/mana-categories'),
        ], 'categories');*/

        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/admin/mana-product-categories'),
        ], 'ProductCategories');
    }
}
