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

Route::prefix('laporan-presensi')->middleware('validate_session')->group(function () {
    Route::get('/list', 'PresensiReportController@ajaxlist')->name('laporan.presensi.ajaxlist');
    Route::get('/export', 'PresensiReportController@downloadExcel')->name('laporan.presensi.export');
    Route::get('/', 'PresensiReportController@index')->name('laporan.presensi.index');
    Route::get('/{id}', 'PresensiReportController@show')->name('laporan.presensi.show');
});
