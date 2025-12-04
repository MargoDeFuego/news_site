<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Форма регистрации
    public function create()
    {
        return view('auth.signin');
    }

    // Обработка регистрации
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|min:2|max:50',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('auth.loginForm')
                         ->with('success', 'Регистрация успешна! Теперь войдите.');
    }

    // Форма логина
    public function loginForm()
    {
        return view('auth.login');
    }

    // Авторизация
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['email' => 'Неверные данные']);
        }

        $request->session()->regenerate();

        // Создаём токен sanctum
        $token = $request->user()->createToken('auth_token')->plainTextToken;

        return redirect('/')
                ->with('token', $token)
                ->with('success', 'Вы успешно вошли!');
    }

    // Выход
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
                ->with('success', 'Вы вышли из аккаунта');
    }
}
