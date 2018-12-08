<?php

namespace App\Providers;

use App\Http\Helpers\CheckPermission;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewHelper extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*',function ($view){
            $view->with('checkPermission',app()->make('checkPermission'));
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('checkPermission',function (){
            return new CheckPermission();
        });
    }
}
