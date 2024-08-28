<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use Modules\Art\Http\Controllers\ArtCategoryController;
use Modules\Art\Http\Controllers\ArtController;
use Modules\Art\Http\Controllers\TagController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('art', ArtController::class);
Route::resource('art-category', ArtCategoryController::class);
Route::resource('art-tag', TagController::class);
