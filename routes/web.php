<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;

// Главная страница через контроллер
Route::get('/', [MainController::class, 'index'])->name('home');

// Статические страницы
Route::get('/about', function () {
    return view('about');
})->name('about');

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

// Общая админка
Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.index');

// Админ галерея
Route::get('/admin/gallery', [MainController::class, 'galleryAdmin'])->name('admin.gallery');
Route::post('/admin/gallery', [MainController::class, 'galleryStore'])->name('admin.gallery.store');

// Авторизация
Route::get('/signin', [AuthController::class, 'create'])->name('auth.create');
Route::post('/signin', [AuthController::class, 'registration'])->name('auth.registration');

// Новости
Route::get('/news', [App\Http\Controllers\ArticleController::class, 'index'])->name('news');

// Админ новости
Route::get('/admin/news', [App\Http\Controllers\AdminArticleController::class, 'index'])->name('admin.news');
Route::post('/admin/news/store', [App\Http\Controllers\AdminArticleController::class, 'store'])->name('admin.store');

// Форма редактирования
Route::get('/admin/news/{id}/edit', [App\Http\Controllers\AdminArticleController::class, 'edit'])->name('admin.news.edit');

// Обновление
Route::put('/admin/news/{id}', [App\Http\Controllers\AdminArticleController::class, 'update'])->name('admin.news.update');

// Удаление
Route::delete('/admin/news/{id}', [App\Http\Controllers\AdminArticleController::class, 'destroy'])->name('admin.news.delete');