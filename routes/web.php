<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin'])->name('login.post');
Route::any('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/password/reset/{id}', [AuthController::class, 'reset'])->name('reset');
Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('reset.password');
Route::get('/password/reset-success', [AuthController::class, 'resetSuccess'])->name('reset.success');

Route::get('/password/forgot', [AuthController::class, 'forgot'])->name('forgot');
Route::POST('/password/forgot', [AuthController::class, 'forgotPost'])->name('forgot.post');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    return "Cache is cleared";
});
