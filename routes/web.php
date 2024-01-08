<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Post;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'post'], function () {
    Route::get('/', [PostController::class, 'index'])->name('post.index');
    Route::get('/lastest', [PostController::class, 'getLastest']);
    Route::get('/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/create', [PostController::class, 'store'])->name('post.store');
    Route::get('/edit/{id}', [PostController::class, 'edit']);
    Route::post('/edit/{id}', [PostController::class, 'update'])->name('post.update');
    Route::get('/delete/{id}', [PostController::class, 'delete'])->name('post.delete');
});

Route::group(['prefix' => 'user'], function () {
    Route::resource('/', UserController::class);
});
