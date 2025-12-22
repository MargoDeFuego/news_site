<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AdminArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CommentModerationController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| УВЕДОМЛЕНИЯ (ВАЖНО: порядок!)
|--------------------------------------------------------------------------
*/


Route::middleware('auth')->get('/notifications/render', function () {
    return view('partials.notifications');
});


Route::middleware('auth')
    ->get('/notifications/{notification}', [NotificationController::class, 'read'])
    ->whereUuid('notification')
    ->name('notifications.read');

/*
|--------------------------------------------------------------------------
| ПУБЛИЧНЫЕ СТРАНИЦЫ
|--------------------------------------------------------------------------
*/

Route::get('/', [MainController::class, 'index'])->name('home');

Route::get('/about', fn () => view('about'))->name('about');

Route::get('/contacts', fn () => view('contacts', [
    'contacts' => [
        'Телефон: +79997777999',
        'Email: m25rita@ya.ru',
        'Адрес: Подольск, Россия',
    ],
]))->name('contacts');

Route::get('/gallery', [MainController::class, 'galleryAll'])->name('gallery.all');
Route::get('/gallery/{id}', [MainController::class, 'gallery'])->name('gallery');
Route::get('/gallery/item/{index}', [MainController::class, 'galleryItem'])->name('gallery.item');

/*
|--------------------------------------------------------------------------
| АВТОРИЗАЦИЯ
|--------------------------------------------------------------------------
*/

Route::get('/register', [AuthController::class, 'create'])->name('auth.create');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('auth.logout');

Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware('auth')
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| НОВОСТИ (доступны гостям)
|--------------------------------------------------------------------------
*/

Route::get('/news', [ArticleController::class, 'index'])->name('news');
Route::get('/news/{article}', [ArticleController::class, 'show'])->name('news.show');

/*
|--------------------------------------------------------------------------
| АДМИНКА (только авторизованные)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/admin', fn () => view('admin.index'))->name('admin.index');

    // --- Галерея ---
    Route::get('/admin/gallery', [MainController::class, 'galleryAdmin'])->name('admin.gallery');
    Route::post('/admin/gallery', [MainController::class, 'galleryStore'])->name('admin.gallery.store');

    // --- Новости (модератор) ---
    Route::middleware('can:create,App\Models\Article')->group(function () {
        Route::get('/admin/news', [AdminArticleController::class, 'index'])->name('admin.news');
        Route::post('/admin/news/store', [AdminArticleController::class, 'store'])->name('admin.store');
        Route::get('/admin/news/{id}/edit', [AdminArticleController::class, 'edit'])->name('admin.news.edit');
        Route::put('/admin/news/{id}', [AdminArticleController::class, 'update'])->name('admin.news.update');
        Route::delete('/admin/news/{id}', [AdminArticleController::class, 'destroy'])->name('admin.news.delete');
    });

    // --- Пользователи (модератор) ---
    Route::middleware('can:manage-users')->group(function () {
        Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::post('/admin/users/{user}/role', [UserController::class, 'updateRole'])->name('admin.users.updateRole');
    });

    // --- Модерация комментариев ---
    Route::middleware('can:isModerator')->group(function () {
        Route::get('/admin/comments', [CommentModerationController::class, 'index'])
            ->name('admin.comments');

        Route::post('/admin/comments/{comment}/approve', [CommentModerationController::class, 'approve'])
            ->name('admin.comments.approve');

        Route::delete('/admin/comments/{comment}', [CommentModerationController::class, 'reject'])
            ->name('admin.comments.reject');
    });
});

/*
|--------------------------------------------------------------------------
| КОММЕНТАРИИ (авторизованные пользователи)
|--------------------------------------------------------------------------
*/

Route::post('/comments', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('comments.store');

Route::put('/comments/{comment}', [CommentController::class, 'update'])
    ->middleware('auth')
    ->name('comments.update');

Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
    ->middleware('auth')
    ->name('comments.destroy');
