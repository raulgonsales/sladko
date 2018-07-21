<?php

namespace App\Providers;

use App\Category;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeCategoriesNavigation();
        $this->composeCart();
    }

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
     * Compose the categories navigation bar.
     */
    public function composeCategoriesNavigation() {
        view()->composer('includes.header', 'App\Http\Composers\CategoriesNavigationComposer');
    }

    /**
     * Compose cart.
     */
    public function composeCart() {
        view()->composer('includes.header', 'App\Http\Composers\CartComposer');
    }
}
