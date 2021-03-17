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

Route::prefix('presensi')->middleware('validate_session')->group(function() {
    Route::get('/list', 'PresensiController@ajaxlist')->name('presensi.ajaxlist');
    Route::get('/', 'PresensiController@index')->name('presensi.index');
    Route::get('/{id}', 'PresensiController@show')->name('presensi.show');
});
