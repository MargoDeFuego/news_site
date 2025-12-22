<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * POST /api/register
     * Регистрация пользователя
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|min:2|max:50',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // создаём Sanctum токен
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Регистрация успешна',
            'user'    => $user,
            'token'   => $token,
        ], 201);
    }

    /**
     * POST /api/login
     * Авторизация пользователя
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Неверные данные для входа',
            ], 401);
        }

        $user = $request->user();

        // удаляем старые токены (по желанию, но правильно)
        $user->tokens()->delete();

        // создаём новый токен
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Успешный вход',
            'user'    => $user,
            'token'   => $token,
        ]);
    }

    /**
     * POST /api/logout
     * Выход (удаление токена)
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Вы вышли из системы',
        ]);
    }
}
