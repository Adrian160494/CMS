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

Route::get('/manage','Manage\ManageController@index')->name('loggedIn');

Route::get('/projekty','Manage\ProjektyController@index')->name('projekty.index');
Route::any('/projekty/create','Manage\ProjektyController@create')->name('projekty.create');
Route::any('/projekty/konfiguracja/{id_projektu?}','Manage\ProjektyController@konfiguracja')->name('projekty.konfiguracja');
Route::get('/projekty/destroy/{id?}','Manage\ProjektyController@destroy')->name('projekty_destroy');

Route::any('/projekty/manage','Manage\ProjektyController@manage')->name('projekty.manage');
Route::any('/projekty/manage/addPage/{id?}','Manage\ProjektyController@addpage')->name('projekty.manage.addpage');
Route::any('/projekty/manage/deletePage/{id?}/{slug?}','Manage\ProjektyController@deletepage')->name('projekty.manage.deletepage');
Route::any('/projekty/manage/addContent','Manage\ProjektyController@addContent')->name('projekty.manage.addContent');
Route::any('/projekty/manage/changeRoute','Manage\ProjektyController@changeRoute')->name('projekty.manage.changeRoute');

Route::any('/cms/menu','CMS\CmsMenuController@index')->name('cms.menu');
Route::any('/cms/changeProjekt','CMS\CmsMenuController@changeProjekt')->name('cms.menu.changeProjekt');
Route::any('/cms/menu/create','CMS\CmsMenuController@create')->name('cms.menucreate');
Route::any('/cms/menu/edit/{id}/{id_projektu}','CMS\CmsMenuController@editMenu')->name('cms.menuedit');
Route::any('/cms/menu/config/{id}','CMS\CmsMenuController@configMenu')->name('cms.menu.config');
Route::any('/cms/menu/delete/{id}','CMS\CmsMenuController@deleteMenu')->name('cms.menudelete');
Route::get('/cms/menu/changeActivity/{id}','CMS\CmsMenuController@changeActivity')->name('cms.menuactivity');
Route::get('/cms/menu/changeSubmenu/{id}','CMS\CmsMenuController@changeSubmenu')->name('cms.menusubmenu');
Route::any('/cms/menu/addPosition/{id}/{id_parent?}','CMS\CmsMenuController@dodajPozycjeMenu')->name('cms.menu.addPosition');
Route::any('/cms/menu/removePosition/{id}/{id_parent?}','CMS\CmsMenuController@delete')->name('cms.menu.removePosition');
