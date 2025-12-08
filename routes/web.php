<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AdminArticleController;
use App\Http\Controllers\CommentController;

// Главная страница
Route::get('/', [MainController::class, 'index'])->name('home');

// Статические страницы
Route::get('/about', fn() => view('about'))->name('about');
Route::get('/contacts', function () {
    $contacts = [
        'Телефон: +79997777999',
        'Email: m25rita@ya.ru',
        'Адрес: Подольск, Россия'
    ];
    return view('contacts', compact('contacts'));
})->name('contacts');

// Галерея
Route::get('/gallery', [MainController::class, 'galleryAll'])->name('gallery.all');
Route::get('/gallery/{id}', [MainController::class, 'gallery'])->name('gallery');
Route::get('/gallery/item/{index}', [MainController::class, 'galleryItem'])->name('gallery.item');

// Админка
Route::get('/admin', fn() => view('admin.index'))->name('admin.index');
Route::get('/admin/gallery', [MainController::class, 'galleryAdmin'])->name('admin.gallery');
Route::post('/admin/gallery', [MainController::class, 'galleryStore'])->name('admin.gallery.store');

// ------------------------------
// 🔥 Блок авторизации
// ------------------------------

// Регистрация
Route::get('/register', [AuthController::class, 'create'])->name('auth.create');            
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');       

// Логин
Route::get('/login', [AuthController::class, 'loginForm'])->name('auth.loginForm');       
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');              

// Выход
Route::post('/logout', [AuthController::class, 'logout'])
     ->middleware('auth:sanctum')
     ->name('auth.logout');

// Защищённая страница
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth:sanctum')->name('dashboard');

// ------------------------------
// Новости
// ------------------------------
Route::get('/news', [ArticleController::class, 'index'])->name('news');

// Админ новости
Route::get('/admin/news', [AdminArticleController::class, 'index'])->name('admin.news');
Route::post('/admin/news/store', [AdminArticleController::class, 'store'])->name('admin.store');
Route::get('/admin/news/{id}/edit', [AdminArticleController::class, 'edit'])->name('admin.news.edit');
Route::put('/admin/news/{id}', [AdminArticleController::class, 'update'])->name('admin.news.update');
Route::delete('/admin/news/{id}', [AdminArticleController::class, 'destroy'])->name('admin.news.delete');

// ------------------------------
// Комментарии
// ------------------------------
Route::post('/comments', [CommentController::class, 'store'])
    ->middleware('auth:sanctum')
    ->name('comments.store');

Route::delete('/comments/{id}', [CommentController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ->name('comments.destroy');

Route::put('/comments/{id}', [CommentController::class, 'update'])
    ->middleware('auth:sanctum')
    ->name('comments.update');

// Комментарии одной статьи
Route::get('/news/{article}', [App\Http\Controllers\ArticleController::class, 'show'])
    ->name('news.show');
