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

Route::any('/cms/menu','CMS\CmsController@index')->name('cms.menu');
Route::any('/cms/changeProjekt','CMS\CmsController@changeProjekt')->name('cms.menu.changeProjekt');
Route::any('/cms/menu/create','CMS\CmsController@create')->name('cms.menucreate');
