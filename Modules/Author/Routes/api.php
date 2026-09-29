<?php

use Illuminate\Support\Facades\Route;
use Modules\Author\Http\Controllers\Api\AuthorApiController;
use Modules\Author\Http\Controllers\Api\AuthorProfileController;

/*
|--------------------------------------------------------------------------
| API Routes – Author Module
|--------------------------------------------------------------------------
|
| RESTful API for Author authentication and profile management.
| Base URL: /api/author
|
| Public  : POST /api/author/login
| Protected (Bearer token):
|           POST   /api/author/logout
|           GET    /api/author/me
|           PATCH  /api/author/me
|
| Public content (trang tác giả ở frontend):
|           GET    /api/authors
|           GET    /api/authors/{author}   (author = username)
|
*/

// ── Public content ─────────────────────────────────────────────────────────
Route::get('authors', [AuthorProfileController::class, 'index'])->name('api.authors.index');
Route::get('authors/{author}', [AuthorProfileController::class, 'show'])->name('api.authors.show');

// ── Public ────────────────────────────────────────────────────────────────
Route::prefix('author')->as('api.author.')->group(function () {
    Route::post('login', [AuthorApiController::class, 'login'])->name('login');
});

// ── Protected (requires valid Sanctum token in Authorization header) ───────
Route::prefix('author')
    ->as('api.author.')
    ->middleware('auth:author')
    ->group(function () {
        Route::post('logout', [AuthorApiController::class, 'logout'])->name('logout');
        Route::get('me',      [AuthorApiController::class, 'me'])->name('me');
        Route::patch('me',    [AuthorApiController::class, 'update'])->name('me.update');
    });