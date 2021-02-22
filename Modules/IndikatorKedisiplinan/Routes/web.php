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

Route::prefix('indikator/kedisiplinan')->group(function() {
    Route::get('/', 'IndikatorKedisiplinanController@index')->name('kedisiplinan.index');
    Route::get('/create', 'IndikatorKedisiplinanController@create')->name('kedisiplinan.create');
    Route::post('/store', 'IndikatorKedisiplinanController@store')->name('kedisiplinan.store');
    Route::post('/destroy', 'IndikatorKedisiplinanController@destroy')->name('kedisiplinan.destroy');
    Route::get('/{id}', 'IndikatorKedisiplinanController@show')->name('kedisiplinan.show');
    Route::post('/{id}/update', 'IndikatorKedisiplinanController@update')->name('kedisiplinan.update');
    Route::get('/{id}/edit', 'IndikatorKedisiplinanController@edit')->name('kedisiplinan.edit');
});