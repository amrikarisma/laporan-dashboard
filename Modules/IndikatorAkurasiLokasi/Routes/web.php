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

Route::prefix('indikator/akurasi-lokasi')->group(function() {
    Route::get('/', 'IndikatorAkurasiLokasiController@index')->name('akurasilokasi.index');
    Route::get('/create', 'IndikatorAkurasiLokasiController@create')->name('akurasilokasi.create');
    Route::post('/store', 'IndikatorAkurasiLokasiController@store')->name('akurasilokasi.store');
    Route::post('/destroy', 'IndikatorAkurasiLokasiController@destroy')->name('akurasilokasi.destroy');
    Route::get('/{id}', 'IndikatorAkurasiLokasiController@show')->name('akurasilokasi.show');
    Route::post('/{id}/update', 'IndikatorAkurasiLokasiController@update')->name('akurasilokasi.update');
    Route::get('/{id}/edit', 'IndikatorAkurasiLokasiController@edit')->name('akurasilokasi.edit');
    Route::delete('/{id}', 'IndikatorAkurasiLokasiController@destroy')->name('akurasilokasi.destroy');
});
