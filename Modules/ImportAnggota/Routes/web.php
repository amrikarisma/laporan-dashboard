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

Route::prefix('importanggota')->group(function() {
    Route::get('/', 'ImportAnggotaController@index');
    Route::post('/create', 'ImportAnggotaController@store')->name('import.store');
});
