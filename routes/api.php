<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Api\Author\AuthorTypeController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!w
|
*/

Route::group(['middleware' => 'throttle:60,1'], function () {
    // Auth
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('register', [AuthController::class, 'register']);

    // Author
    Route::get('author', [AuthorController::class, 'index']);
    Route::get('author/{slug}', [AuthorController::class, 'show']);
    Route::put('author/{slug}', [AuthorController::class, 'changeStatus']);
    Route::post('author/store', [AuthorController::class, 'store']);

    // Author type
    Route::get('author-types', [AuthorTypeController::class, 'index']);
});
Route::apiResource('faqs', FaqController::class);
