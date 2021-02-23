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

Route::prefix('indikator/bobot-kegiatan')->group(function() {
    Route::get('/', 'IndikatorBobotKegiatanController@index')->name('bobotkegiatan.index');
    Route::get('/create', 'IndikatorBobotKegiatanController@create')->name('bobotkegiatan.create');
    Route::post('/store', 'IndikatorBobotKegiatanController@store')->name('bobotkegiatan.store');
    Route::post('/destroy', 'IndikatorBobotKegiatanController@destroy')->name('bobotkegiatan.destroy');
    Route::get('/{id}', 'IndikatorBobotKegiatanController@show')->name('bobotkegiatan.show');
    Route::post('/{id}/update', 'IndikatorBobotKegiatanController@update')->name('bobotkegiatan.update');
    Route::get('/{id}/edit', 'IndikatorBobotKegiatanController@edit')->name('bobotkegiatan.edit');
    Route::delete('/{id}', 'IndikatorBobotKegiatanController@destroy')->name('bobotkegiatan.destroy');
});
