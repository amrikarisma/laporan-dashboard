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

Route::prefix('anggota')->middleware(['validate_session', 'has_access:1,2'])->group(function () {
    Route::get('/list', 'AnggotaController@getListAnggota')->name('anggota.listanggota');
    Route::get('/', 'AnggotaController@index')->name('anggota.index');
    Route::get('/create', 'AnggotaController@create')->name('anggota.create');
    Route::post('/create', 'AnggotaController@store')->name('anggota.store');
    Route::get('/{id}', 'AnggotaController@show')->name('anggota.show');
    Route::post('/{id}/update', 'AnggotaController@update')->name('anggota.update');
    Route::get('/{id}/edit', 'AnggotaController@edit')->name('anggota.edit');
});
