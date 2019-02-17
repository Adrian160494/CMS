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

//Image Script transform

Route::any('/transform_image','Scripts\ImageController@transformImage')->name('transformImage');

Route::any('/', "Auth\LoginController@login")->name('loginAction');
Route::get('/logout','Auth\LoginController@logout')->name('logout');
Route::any('/setPassword','Auth\LoginController@setPassword')->name('setPassword');

Route::get('/manage','Manage\ManageController@index')->name('loggedIn');

Route::get('/users','Users\UsersController@index')->name('users.index');
Route::any('/users/create','Users\UsersController@create')->name('users.user.create');
Route::any('/users/delete','Users\UsersController@delete')->name('users.user.delete');
Route::any('/users/config/{id}','Users\UsersController@konfiguracja')->name('users.user.config');
Route::any('/users/activateAccount','Users\UsersController@activateAccount')->name('users.user.activate');

Route::any('/users/permissions','Users\PermissionsController@index')->name('users.permissions');
Route::any('/users/permissions/changePermission/{id}','Users\PermissionsController@changePermission')->name('users.permission.change');

Route::any('/admin','Panel\AdminController@index')->name('panel.index');
Route::any('/admin/addModules','Panel\AdminController@addModules')->name('panel.addModules');

Route::get('/projekty','Manage\ProjektyController@index')->name('projects');
Route::get('/projekty/list','Manage\ProjektyController@projekty')->name('projects.projects.list');
Route::any('/projekty/create','Manage\ProjektyController@create')->name('projects.projects.create');
Route::any('/projekty/edit/{id}','Manage\ProjektyController@edit')->name('projects.projects.edit');
Route::any('/projekty/konfiguracja/{id_projektu?}','Manage\ProjektyController@konfiguracja')->name('projects.projects.config');
Route::get('/projekty/destroy/{id?}','Manage\ProjektyController@destroy')->name('projects.projects.delete');

Route::any('/projekty/manage','Manage\ProjektyController@manage')->name('projects.manage');
Route::any('/projekty/manage/addPage/{id?}','Manage\ProjektyController@addpage')->name('projects.manage.addpage');
Route::any('/projekty/manage/deletePage/{id?}/{slug?}','Manage\ProjektyController@deletepage')->name('projects.manage.deletepage');
Route::any('/projekty/manage/addContent','Manage\ProjektyController@addContent')->name('projects.manage.addContent');
Route::any('/projekty/manage/changeRoute','Manage\ProjektyController@changeRoute')->name('projects.manage.changeRoute');

Route::any('/cms','CMS\CmsMenuController@index')->name('cms');
Route::any('/cms/menu','CMS\CmsMenuController@menu')->name('cms.menu');
Route::any('/cms/changeProjekt','CMS\CmsMenuController@changeProjekt')->name('cms.menu.changeProjekt');
Route::any('/cms/menu/create','CMS\CmsMenuController@create')->name('cms.menu.create');
Route::any('/cms/menu/edit/{id}/{id_projektu}','CMS\CmsMenuController@editMenu')->name('cms.menu.edit');
Route::any('/cms/menu/config/{id}','CMS\CmsMenuController@configMenu')->name('cms.menu.config');
Route::any('/cms/menu/delete/{id}','CMS\CmsMenuController@deleteMenu')->name('cms.menu.delete');
Route::get('/cms/menu/changeActivity/{id}','CMS\CmsMenuController@changeActivity')->name('cms.menu.activity');
Route::get('/cms/menu/changeSubmenu/{id}','CMS\CmsMenuController@changeSubmenu')->name('cms.menu.submenu');
Route::any('/cms/menu/addPosition/{id}/{id_parent?}','CMS\CmsMenuController@dodajPozycjeMenu')->name('cms.menu.addPosition');
Route::any('/cms/menu/removePosition/{id}/{id_parent?}','CMS\CmsMenuController@delete')->name('cms.menu.removePosition');
Route::any('/cms/menu/editPosition/{id}','CMS\CmsMenuController@editPosition')->name('cms.menu.editPosition');


Route::any('/cms/bannery','CMS\CmsBanneryController@index')->name('cms.bannery');
Route::any('/cms/bannery/changeProjekt','CMS\CmsBanneryController@changeProjekt')->name('cms.bannery.changeProjekt');
Route::any('/cms/bannery/create','CMS\CmsBanneryController@createBanner')->name('cms.bannery.create');
Route::get('/cms/bannery/changeActivity/{id}','CMS\CmsBanneryController@changeActivity')->name('cms.bannery.activity');
Route::any('/cms/bannery/delete/{id}','CMS\CmsBanneryController@delete')->name('cms.bannery.delete');
Route::any('/cms/bannery/config/{id}/{id_projektu}','CMS\CmsBanneryController@configBanner')->name('cms.bannery.config');
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
Route::any('/configuration/pictures','Ustawienia\PicturesController@config')->name('config.pictures.list');
Route::any('/configuration/pictures/create','Ustawienia\PicturesController@create')->name('config.pictures.create');
Route::any('/configuration/pictures/delete/{id}','Ustawienia\PicturesController@delete')->name('config.pictures.delete');

Route::any('/configuration/categories','Ustawienia\CategoriesController@index')->name('config.categories.list');
Route::any('/configuration/categories/create','Ustawienia\CategoriesController@create')->name('config.categories.create');
Route::any('/configuration/categories/delete/{id}','Ustawienia\CategoriesController@delete')->name('config.categories.delete');
Route::any('/configuration/categories/changeActivity/{id}','Ustawienia\CategoriesController@changeActivity')->name('config.categories.Activity');

Route::any('/configuration/gallery','Ustawienia\GalleryController@index')->name('config.galleries.list');
Route::any('/configuration/gallery/create','Ustawienia\GalleryController@create')->name('config.galleries.create');
Route::any('/configuration/gallery/config/{id}','Ustawienia\GalleryController@configGallery')->name('config.galleries.config');
Route::any('/configuration/gallery/createElement/{id}','Ustawienia\GalleryController@createElement')->name('config.galleries.createElement');
Route::any('/configuration/gallery/edit/{id}','Ustawienia\GalleryController@create')->name('config.galleries.edit');
Route::any('/configuration/gallery/editElement/{id}','Ustawienia\GalleryController@editElement')->name('config.galleries.editElement');
Route::any('/configuration/gallery/delete/{id}','Ustawienia\GalleryController@delete')->name('config.galleries.delete');
Route::get('/configuration/gallery/changeActivity/{id}','Ustawienia\GalleryController@changeActivity')->name('config.galleries.Activity');
Route::any('/configuration/gallery/deleteElement/{id}','Ustawienia\GalleryController@deleteElement')->name('config.galleries.deleteElement');
