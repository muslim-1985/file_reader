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

Route::get('/', 'AppController@index');

Auth::routes();
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', 'AdminController@index')->name('home');
    Route::get('create', 'AdminController@create')->name('create');
    Route::post('createDoc', 'AdminController@store')->name('createDoc');
    Route::delete('doc/{id}', 'AdminController@delete')->name('delDoc');
    Route::get('show/{id}', 'AdminController@show')->name('show');
    Route::delete('file/{id}', 'AdminController@fileDestroy')->name('delFile');
    Route::patch('document/{id}', 'AdminController@store')->name('update');
    Route::get('copy/{id}', 'AdminController@copy')->name('copy');
});

