<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Controllers
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\CommentController;

/*
|--------------------------------------------------------------------------
| AUTH (API)
|--------------------------------------------------------------------------
| POST /api/login
| POST /api/register
*/

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

/*
|--------------------------------------------------------------------------
| NEWS (PUBLIC API)
|--------------------------------------------------------------------------
| GET /api/news
| GET /api/news/{article}
*/

Route::get('/news', [ArticleController::class, 'index']);
Route::get('/news/{article}', [ArticleController::class, 'show']);

/*
|--------------------------------------------------------------------------
| PROTECTED API (Sanctum)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | NEWS (MODERATOR)
    |--------------------------------------------------------------------------
    | POST   /api/news
    | PUT    /api/news/{article}
    | DELETE /api/news/{article}
    */

    Route::post('/news', [ArticleController::class, 'store']);
    Route::put('/news/{article}', [ArticleController::class, 'update']);
    Route::delete('/news/{article}', [ArticleController::class, 'destroy']);

    /*
    |--------------------------------------------------------------------------
    | COMMENTS
    |--------------------------------------------------------------------------
    | POST /api/comments
    | PUT  /api/comments/{comment}
    | DELETE /api/comments/{comment}
    */

    Route::post('/comments', [CommentController::class, 'store']);
    Route::put('/comments/{comment}', [CommentController::class, 'update']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', [AuthController::class, 'logout']);
});
