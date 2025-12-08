<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;

// Главная страница
Route::get('/', [MainController::class, 'index'])->name('home');

// Статические страницы
Route::get('/about', fn() => view('about'))->name('about');
Route::get('/contacts', function () {
    $contacts = [
        'Телефон: +79175203699',
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
Route::get('/news', [App\Http\Controllers\ArticleController::class, 'index'])->name('news');

// Админ новости
Route::get('/admin/news', [App\Http\Controllers\AdminArticleController::class, 'index'])->name('admin.news');
Route::post('/admin/news/store', [App\Http\Controllers\AdminArticleController::class, 'store'])->name('admin.store');
Route::get('/admin/news/{id}/edit', [App\Http\Controllers\AdminArticleController::class, 'edit'])->name('admin.news.edit');
Route::put('/admin/news/{id}', [App\Http\Controllers\AdminArticleController::class, 'update'])->name('admin.news.update');
Route::delete('/admin/news/{id}', [App\Http\Controllers\AdminArticleController::class, 'destroy'])->name('admin.news.delete');
