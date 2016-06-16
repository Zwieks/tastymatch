<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view){
            $view_array = explode('.', $view->getName());

            /* Current template name */
            $type = $view_array[1];

            /* Browser Locale */
            $locale = App()->getLocale();

            $view->with(compact('type', 'locale'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
