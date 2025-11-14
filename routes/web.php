<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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
Route::get('/gallery/{id}', [MainController::class, 'gallery'])->name('gallery');

// Общая админка
Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.index');

Route::get('/admin/news', [MainController::class, 'admin'])->name('admin.news');
Route::post('/admin/news', [MainController::class, 'store'])->name('admin.store');
Route::get('/admin/gallery', [MainController::class, 'galleryAdmin'])->name('admin.gallery');
Route::post('/admin/gallery', [MainController::class, 'galleryStore'])->name('admin.gallery.store');
