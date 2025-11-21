<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Показ страницы регистрации
    public function create()
    {
        return view('auth.signin');
    }


    // Обработка формы
    public function registration(Request $request)
    {
        // Валидация входящих данных
        $validated = $request->validate([
            'name'     => 'required|string|min:2|max:50',
            'email'    => 'required|email',
            'password' => 'required|min:6'
        ]);

        // Возвращаем данные в JSON
        return response()->json([
            'status' => 'success',
            'data'   => $validated
        ]);
    }
}