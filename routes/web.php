<?php

use App\Http\Controllers\AuthController as DemoRealTimeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/send-noti', [HomeController::class, 'sendNoti']);
Route::get('register-mail', [DemoRealTimeController::class, 'register']);
Route::group(['prefix' => 'contact', 'as' => 'contact.'], function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::post('/', [ContactController::class, 'store'])->name('store');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/login', [AuthController::class, 'loginAdmin'])->name('getLogin');
    Route::post('/login', [AuthController::class, 'postLoginAdmin'])->name('postLogin');
    Route::post('/logoutAdmin', [AuthController::class, 'logoutAdmin'])->name('logout');
});
