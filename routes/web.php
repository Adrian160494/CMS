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

Route::resource('projekty','Manage\ProjektyController');
Route::post('/projekty/create','Manage\ProjektyController@create');
