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

Route::prefix('history')->middleware('validate_session')->group(function() {
    Route::get('/export', 'HistoryController@downloadExcel')->name('history.export');
    Route::post('/list', 'HistoryController@location')->name('history.location');
    Route::get('/', 'HistoryController@index')->name('history.index');
    Route::post('/', 'HistoryController@index');
});
