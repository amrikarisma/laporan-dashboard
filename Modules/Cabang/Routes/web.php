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

Route::prefix('unit-cabang')->group(function() {
    Route::get('/data', 'CabangController@getCabang')->name('cabang.data');
    Route::get('/', 'CabangController@index')->name('cabang.index');
    Route::get('/create', 'CabangController@create')->name('cabang.create');
    Route::post('/create', 'CabangController@store')->name('cabang.store');
    Route::post('{id}/update', 'CabangController@update')->name('cabang.update');
    Route::get('/{id}/edit', 'CabangController@edit')->name('cabang.edit');
    Route::get('/{id}', 'CabangController@show')->name('cabang.show');
    Route::delete('/{id}', 'CabangController@destroy')->name('cabang.destroy');
});
