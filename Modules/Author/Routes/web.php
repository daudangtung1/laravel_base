<?php

use Illuminate\Support\Facades\Route;
use Modules\Author\Http\Controllers\Admin\AdminAuthController;
use Modules\Author\Http\Controllers\Admin\AuthorTypeController;
use Modules\Author\Http\Controllers\Admin\AuthorController;

/*
|--------------------------------------------------------------------------
| Web Routes – Author Module
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Auth routes (no middleware – publicly accessible)
|--------------------------------------------------------------------------
*/
Route::prefix('author')->as('author.')->group(function () {
    Route::get('login',  [AdminAuthController::class, 'create'])->name('login');
    Route::post('login', [AdminAuthController::class, 'store'])->name('login.post');
    Route::post('logout', [AdminAuthController::class, 'destroy'])
        ->middleware('admin')
        ->name('logout');
});

/*
|--------------------------------------------------------------------------
| Protected routes (require admin middleware)
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    Route::resource('author-types', AuthorTypeController::class)
        ->except(['show'])
        ->names('author-types');

    Route::resource('authors', AuthorController::class)
        ->except(['show'])
        ->names('authors');
});

