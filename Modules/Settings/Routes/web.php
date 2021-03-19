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

Route::prefix('settings')->group(function() {
    Route::get('/', 'SettingsController@index')->name('settings.index');
    Route::post('/{id}', 'SettingsController@update')->name('settings.update');
});
