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

use Illuminate\Support\Facades\Route;

Route::prefix('divisi')->group(function() {
    Route::get('/', 'DivisiController@index')->name('divisi.index');
    Route::get('/create', 'DivisiController@create')->name('divisi.create');
    Route::post('/create', 'DivisiController@store')->name('divisi.store');
    Route::post('{id}/update', 'DivisiController@update')->name('divisi.update');
    Route::get('/{id}/edit', 'DivisiController@edit')->name('divisi.edit');
    Route::get('/{id}', 'DivisiController@show')->name('divisi.show');
    Route::delete('/{id}', 'DivisiController@destroy')->name('divisi.destroy');
});
