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

Route::prefix('laporan-gps')->middleware('validate_session')->group(function () {
    Route::get('/list', 'GPSReportController@ajaxlist')->name('laporan.gps.ajaxlist');
    Route::get('/export', 'GPSReportController@downloadExcel')->name('laporan.gps.export');
    Route::get('/', 'GPSReportController@index')->name('laporan.gps.index');
    Route::get('/{id}', 'GPSReportController@show')->name('laporan.gps.show');
});