@extends('layouts.app')

@section('content')

<h1>Вход в систему</h1>

{{-- Сообщение после успешной регистрации --}}
@if(session('success'))
    <p style="color: green; font-weight:bold;">
        {{ session('success') }}
    </p>
@endif

{{-- Ошибки авторизации --}}
@if ($errors->any())
    <div style="color:red; font-weight:bold;">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form action="{{ route('auth.login') }}" method="POST">
    @csrf

    <div style="margin-bottom: 15px;">
        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}" required>
        @error('email')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <div style="margin-bottom: 15px;">
        <label>Пароль:</label><br>
        <input type="password" name="password" required>
        @error('password')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">Войти</button>
</form>

<br>

{{-- Ссылка на регистрацию --}}
<a href="{{ route('auth.create') }}">Нет аккаунта? Зарегистрироваться</a>

@endsection
