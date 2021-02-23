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

Route::prefix('news')->group(function() {
    Route::get('/', 'NewsController@index')->name('news.index');
    Route::get('/create', 'NewsController@create')->name('news.create');
    Route::post('/store', 'NewsController@store')->name('news.store');
    Route::post('/destroy', 'NewsController@destroy')->name('news.destroy');
    Route::get('/{id}', 'NewsController@show')->name('news.show');
    Route::post('/{id}/update', 'NewsController@update')->name('news.update');
    Route::get('/{id}/edit', 'NewsController@edit')->name('news.edit');
    Route::delete('/{id}', 'NewsController@destroy')->name('news.destroy');
});
