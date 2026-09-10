<?php

use Illuminate\Support\Facades\Route;
use Modules\Post\Http\Controllers\Api\CategoryController;
use Modules\Post\Http\Controllers\Api\PostController;

Route::get('categories', [CategoryController::class, 'index'])->name('api.post-categories.index');
Route::get('categories/{postCategory:slug}', [CategoryController::class, 'show'])->name('api.post-categories.show');
Route::get('posts', [PostController::class, 'index'])->name('api.posts.index');
Route::get('posts/{post:slug}', [PostController::class, 'show'])->name('api.posts.show');
