<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contacts', function () {
    $contacts = ['Телефон: +79175203699', 'Email: m25rita@ya.ru', 'Адрес: Подольск, Россия'];
    return view('contacts', compact('contacts'));
})->name('contacts');