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

Route::prefix('broadcast')->group(function() {
    Route::get('/', 'BroadcastController@index')->name('broadcast.index');
    Route::get('/create', 'BroadcastController@create')->name('broadcast.create');
    Route::post('/store', 'BroadcastController@store')->name('broadcast.store');
    Route::post('/destroy', 'BroadcastController@destroy')->name('broadcast.destroy');
    Route::get('/{id}', 'BroadcastController@show')->name('broadcast.show');
    Route::post('/{id}/update', 'BroadcastController@update')->name('broadcast.update');
    Route::get('/{id}/edit', 'BroadcastController@edit')->name('broadcast.edit');
    Route::delete('/{id}', 'BroadcastController@destroy')->name('broadcast.destroy');
});
