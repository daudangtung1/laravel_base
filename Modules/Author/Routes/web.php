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
use Modules\Author\Http\Controllers\AuthorController;

Route::prefix('author')->as('author.')->group(function () {
    Route::get('/', 'AuthorController@index');
    Route::get('/dashboard', [AuthorController::class, 'dashboard'])->name('dashboard');
});
