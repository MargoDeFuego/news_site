@extends('layouts.app')

@section('content')

<h1>Регистрация</h1>

{{-- Сообщение после успешной регистрации --}}
@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<form action="{{ route('auth.register') }}" method="POST">
    @csrf

    <div>
        <label>Имя:</label><br>
        <input type="text" name="name" value="{{ old('name') }}" required>
        @error('name')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}" required>
        @error('email')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>Пароль:</label><br>
        <input type="password" name="password" required>
        @error('password')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <br>
    <button type="submit">Зарегистрироваться</button>
</form>

<br>

<a href="{{ route('auth.loginForm') }}">Уже есть аккаунт? Войти</a>

@endsection
