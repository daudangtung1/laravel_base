<?php

use Illuminate\Support\Facades\Route;
use Modules\Author\Http\Controllers\Api\AuthorApiController;

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
*/

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