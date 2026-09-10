<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\ActivityController;
use Modules\Admin\Http\Controllers\AdminAuthController;
use Modules\Admin\Http\Controllers\AdminController;

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

Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'create'])->name('getLogin');
    Route::post('login', [AdminAuthController::class, 'store'])->name('postLogin');
    Route::post('logout', [AdminAuthController::class, 'destroy'])->middleware('admin')->name('logout');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/activity', [ActivityController::class, 'index'])->name('activity');
});
