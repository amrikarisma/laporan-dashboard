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

Route::prefix('kategori-laporan')->middleware('validate_session')->group(function() {
    Route::get('/list', 'KategoriLaporanController@ajaxlist')->name('kategori-laporan.ajaxlist');
    Route::get('/', 'KategoriLaporanController@index')->name('kategori-laporan.index');
    Route::get('/create', 'KategoriLaporanController@create')->name('kategori-laporan.create');
    Route::post('/store', 'KategoriLaporanController@store')->name('kategori-laporan.store');
    Route::get('/{id}', 'KategoriLaporanController@show')->name('kategori-laporan.show');
    Route::post('/{id}/update', 'KategoriLaporanController@update')->name('kategori-laporan.update');
    Route::get('/{id}/edit', 'KategoriLaporanController@edit')->name('kategori-laporan.edit');
    Route::delete('/{id}', 'KategoriLaporanController@destroy')->name('kategori-laporan.destroy');
});
