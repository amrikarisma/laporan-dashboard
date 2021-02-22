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

Route::prefix('jabatan')->middleware('validate_session')->group(function() {
    Route::get('/', 'JabatanController@index')->name('jabatan.index');
    Route::get('/create', 'JabatanController@create')->name('jabatan.create');
    Route::post('/create', 'JabatanController@store')->name('jabatan.store');
    Route::post('{id}/update', 'JabatanController@update')->name('jabatan.update');
    Route::get('/{id}/edit', 'JabatanController@edit')->name('jabatan.edit');
    Route::get('/{id}', 'JabatanController@show')->name('jabatan.show');
    Route::delete('/{id}', 'JabatanController@destroy')->name('jabatan.destroy');
});