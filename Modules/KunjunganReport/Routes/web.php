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

Route::prefix('laporan-kunjungan')->middleware('validate_session')->group(function () {
    Route::get('/list', 'KunjunganReportController@ajaxlist')->name('laporan.kunjungan.ajaxlist');
    Route::get('/', 'KunjunganReportController@index')->name('laporan.kunjungan.index');
    Route::get('/{id}', 'KunjunganReportController@show')->name('laporan.kunjungan.show');
    Route::post('/', 'KunjunganReportController@index')->name('laporan.kunjungan.post');
});