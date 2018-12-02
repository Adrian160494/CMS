<?php

namespace App\Providers;

use App\Http\Model\Service\BaneryModel;
use App\Http\Model\Service\BanneryPositionsModel;
use App\Http\Model\Service\FileModel;
use App\Http\Model\Service\ImagesSizeModel;
use App\Http\Model\Service\PictureSizeModel;
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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('bannery',function(){
            return new BaneryModel();
        });
        $this->app->singleton('banneryElements',function(){
            return new BanneryPositionsModel();
        });
        $this->app->singleton('Files',function(){
            return new FileModel();
        });
        $this->app->singleton('Size',function(){
            return new PictureSizeModel();
        });
        $this->app->singleton('ImageSizes',function(){
            return new ImagesSizeModel();
        });
    }
}
