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

Route::prefix('laporan-kunjungan')->group(function() {
    Route::get('/', 'KunjunganController@index')->name('kunjungan.index');
    Route::get('/{id}', 'KunjunganController@show')->name('kunjungan.show');
    Route::post('/', 'KunjunganController@index')->name('kunjungan.post');
});
