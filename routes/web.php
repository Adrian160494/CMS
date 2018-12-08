<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::any('/', "Auth\LoginController@login")->name('loginAction');
Route::get('/logout','Auth\LoginController@logout')->name('logout');
Route::any('/setPassword','Auth\LoginController@setPassword')->name('setPassword');

Route::get('/manage','Manage\ManageController@index')->name('loggedIn');

Route::get('/users','Users\UsersController@index')->name('users.index');
Route::any('/users/create','Users\UsersController@create')->name('users.userscreate');
Route::any('/users/delete','Users\UsersController@delete')->name('users.usersdelete');
Route::any('/users/config/{id}','Users\UsersController@konfiguracja')->name('users.usersconfig');
Route::any('/users/activateAccount','Users\UsersController@activateAccount')->name('users.activate');

Route::any('/users/permissions','Users\PermissionsController@index')->name('users.permissions');
Route::any('/users/permissions/changePermission/{id}','Users\PermissionsController@changePermission')->name('users.permissionschange');


Route::any('/admin','Panel\AdminController@index')->name('panel.index');
Route::any('/admin/addModules','Panel\AdminController@addModules')->name('panel.addModules');

Route::get('/projekty','Manage\ProjektyController@index')->name('projekty');
Route::get('/projekty/list','Manage\ProjektyController@projekty')->name('projekty.projekty');
Route::any('/projekty/create','Manage\ProjektyController@create')->name('projekty.create');
Route::any('/projekty/konfiguracja/{id_projektu?}','Manage\ProjektyController@konfiguracja')->name('projekty.konfiguracja');
Route::get('/projekty/destroy/{id?}','Manage\ProjektyController@destroy')->name('projekty_destroy');

Route::any('/projekty/manage','Manage\ProjektyController@manage')->name('projekty.manage');
Route::any('/projekty/manage/addPage/{id?}','Manage\ProjektyController@addpage')->name('projekty.manage.addpage');
Route::any('/projekty/manage/deletePage/{id?}/{slug?}','Manage\ProjektyController@deletepage')->name('projekty.manage.deletepage');
Route::any('/projekty/manage/addContent','Manage\ProjektyController@addContent')->name('projekty.manage.addContent');
Route::any('/projekty/manage/changeRoute','Manage\ProjektyController@changeRoute')->name('projekty.manage.changeRoute');

Route::any('/cms','CMS\CmsMenuController@index')->name('cms');
Route::any('/cms/menu','CMS\CmsMenuController@menu')->name('cms.menu');
Route::any('/cms/changeProjekt','CMS\CmsMenuController@changeProjekt')->name('cms.menu.changeProjekt');
Route::any('/cms/menu/create','CMS\CmsMenuController@create')->name('cms.menucreate');
Route::any('/cms/menu/edit/{id}/{id_projektu}','CMS\CmsMenuController@editMenu')->name('cms.menuedit');
Route::any('/cms/menu/config/{id}','CMS\CmsMenuController@configMenu')->name('cms.menu.config');
Route::any('/cms/menu/delete/{id}','CMS\CmsMenuController@deleteMenu')->name('cms.menudelete');
Route::get('/cms/menu/changeActivity/{id}','CMS\CmsMenuController@changeActivity')->name('cms.menuactivity');
Route::get('/cms/menu/changeSubmenu/{id}','CMS\CmsMenuController@changeSubmenu')->name('cms.menusubmenu');
Route::any('/cms/menu/addPosition/{id}/{id_parent?}','CMS\CmsMenuController@dodajPozycjeMenu')->name('cms.menu.addPosition');
Route::any('/cms/menu/removePosition/{id}/{id_parent?}','CMS\CmsMenuController@delete')->name('cms.menu.removePosition');

Route::any('/cms/bannery','CMS\CmsBanneryController@index')->name('cms.bannery');
Route::any('/cms/bannery/changeProjekt','CMS\CmsBanneryController@changeProjekt')->name('cms.bannery.changeProjekt');
Route::any('/cms/bannery/create','CMS\CmsBanneryController@createBanner')->name('cms.bannery.create');
Route::get('/cms/bannery/changeActivity/{id}','CMS\CmsBanneryController@changeActivity')->name('cms.banneryactivity');
Route::any('/cms/bannery/delete/{id}','CMS\CmsBanneryController@delete')->name('cms.bannerydelete');
Route::any('/cms/bannery/config/{id}/{id_projektu}','CMS\CmsBanneryController@configBanner')->name('cms.banneryconfig');
Route::any('/cms/bannery/createElement/{id_baneru}/{id_projektu}','CMS\CmsBanneryController@createBannerElement')->name('cms.bannery.createElement');
Route::any('/cms/bannery/deleteElement/{id_baneru}','CMS\CmsBanneryController@deleteElement')->name('cms.bannery.deleteElement');
Route::any('/cms/bannery/changeElementActivity/{id_baneru}','CMS\CmsBanneryController@changeElementActivity')->name('cms.bannery.changeElementActivity');
Route::any('/cms/bannery/resize/{id}/{width}/{height}/{id_size}','CMS\CmsBanneryController@resizePicture')->name('config.pictureresize');

Route::any('/cms/posts','CMS\CmsPostsController@index')->name('cms.posts');
Route::any('/cms/posts/changeProjekt','CMS\CmsPostsController@changeProjekt')->name('cms.posts.changeProjekt');
Route::any('/cms/posts/create','CMS\CmsPostsController@create')->name('cms.posts.create');
Route::get('/cms/posts/changeActivity/{id}','CMS\CmsPostsController@changeActivity')->name('cms.posts.activity');
Route::any('/cms/posts/delete/{id}','CMS\CmsPostsController@delete')->name('cms.posts.delete');
Route::any('/cms/posts/edit/{id}','CMS\CmsPostsController@edit')->name('cms.posts.edit');

Route::any('/configuration','Ustawienia\PicturesController@index')->name('config');
Route::any('/configuration/pictures','Ustawienia\PicturesController@config')->name('config.pictures');
Route::any('/configuration/pictures/create','Ustawienia\PicturesController@create')->name('config.picturescreate');
Route::any('/configuration/pictures/delete/{id}','Ustawienia\PicturesController@delete')->name('config.picturesdelete');

Route::any('/configuration/categories','Ustawienia\CategoriesController@index')->name('config.categories');
Route::any('/configuration/categories/create','Ustawienia\CategoriesController@create')->name('config.categoriescreate');
Route::any('/configuration/categories/delete/{id}','Ustawienia\CategoriesController@delete')->name('config.categoriesdelete');
Route::any('/configuration/categories/changeActivity/{id}','Ustawienia\CategoriesController@changeActivity')->name('config.categoriesActivity');
