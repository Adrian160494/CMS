<?php

namespace App\Providers;

use App\Http\Model\Service\BaneryModel;
use App\Http\Model\Service\BanneryPositionsModel;
use App\Http\Model\Service\CategoriesModel;
use App\Http\Model\Service\FileModel;
use App\Http\Model\Service\GalleryElementsModel;
use App\Http\Model\Service\GalleryModel;
use App\Http\Model\Service\ImagesSizeModel;
use App\Http\Model\Service\PermissionsModel;
use App\Http\Model\Service\PictureSizeModel;
use App\Http\Model\Service\PostsModel;
use App\Http\Model\Service\TypesModel;
use App\Http\Model\Service\UsersModel;
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
        $this->app->singleton('Categories',function(){
            return new CategoriesModel();
        });
        $this->app->singleton('Posts',function(){
            return new PostsModel();
        });
        $this->app->singleton('Users',function(){
            return new UsersModel();
        });
        $this->app->singleton('UsersTypes',function(){
            return new TypesModel();
        });
        $this->app->singleton('Permissions',function(){
            return new PermissionsModel();
        });
        $this->app->singleton('Galleries',function(){
            return new GalleryModel();
        });
        $this->app->singleton('GalleriesElements',function(){
            return new GalleryElementsModel();
        });
    }
}
