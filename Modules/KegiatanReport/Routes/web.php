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

Route::prefix('laporan-kegiatan')->middleware('validate_session')->group(function() {
    Route::get('/list', 'KegiatanReportController@ajaxlist')->name('laporan.kegiatan.ajaxlist');
    Route::get('/', 'KegiatanReportController@index')->name('laporan.kegiatan.index');
    Route::get('/export', 'KegiatanReportController@downloadExcel')->name('laporan.kegiatan.export');
    Route::get('/{id}', 'KegiatanReportController@show')->name('laporan.kegiatan.show');
    Route::post('/{id}/update', 'KegiatanReportController@update')->name('laporan.kegiatan.update');
});