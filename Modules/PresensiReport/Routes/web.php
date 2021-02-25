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
    Route::get('/', 'PresensiReportController@index')->name('laporan.presensi.index');
    Route::get('/create', 'PresensiReportController@create')->name('laporan.presensi.create');
    Route::post('/create', 'PresensiReportController@store')->name('laporan.presensi.store');
    Route::get('/{id}', 'PresensiReportController@show')->name('laporan.presensi.show');
    Route::post('/{id}/update', 'PresensiReportController@update')->name('laporan.presensi.update');
    Route::get('/{id}/edit', 'PresensiReportController@edit')->name('laporan.presensi.edit');
});
