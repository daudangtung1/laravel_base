<?php

use Illuminate\Support\Facades\Route;
use Modules\Post\Http\Controllers\Admin\CategoryController;
use Modules\Post\Http\Controllers\Admin\PostController;

Route::prefix('admin')->as('admin.')->middleware('admin')->group(function () {
    Route::resource('post-categories', CategoryController::class)->except('show');
    Route::resource('posts', PostController::class)->except('show');
});
