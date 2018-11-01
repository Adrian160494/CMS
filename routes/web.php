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
