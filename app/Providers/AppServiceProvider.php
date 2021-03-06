<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use App\globalinfo;

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
            if(isset($view_array[1])){
                $type = $view_array[1];
            }else{
                $type = $view_array[0];
            }
            /* Browser Locale */
            $locale = App()->getLocale();
            /* Get the global site information */
            $globals = globalinfo::GetAllItems();

            $globals = $globals[0];
            /* Set debug path */
            $debugpath = 'resources/views/'.str_replace('.', '/', $view->getName()).'.blade.php';
            $view->with(compact('type', 'locale', 'debugpath', 'globals'));
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