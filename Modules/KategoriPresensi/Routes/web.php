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

Route::prefix('kategori-presensi')->middleware(['validate_session', 'has_access:1'])->group(function () {
    Route::get('/list', 'KategoriPresensiController@ajaxlist')->name('kategori-presensi.ajaxlist');
    Route::get('/', 'KategoriPresensiController@index')->name('kategori-presensi.index');
    Route::get('/create', 'KategoriPresensiController@create')->name('kategori-presensi.create');
    Route::post('/store', 'KategoriPresensiController@store')->name('kategori-presensi.store');
    Route::get('/{id}', 'KategoriPresensiController@show')->name('kategori-presensi.show');
    Route::post('/{id}/update', 'KategoriPresensiController@update')->name('kategori-presensi.update');
    Route::get('/{id}/edit', 'KategoriPresensiController@edit')->name('kategori-presensi.edit');
    Route::delete('/{id}', 'KategoriPresensiController@destroy')->name('kategori-presensi.destroy');
});
