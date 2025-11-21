@extends('layouts.app')
@section('content')

<h1>Регистрация</h1>

    <form action="{{ route('auth.registration') }}" method="POST">
        @csrf     {{-- CSRF токен обязателен --}}

        <div>
            <label>Имя:</label><br>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name') <p style="color:red">{{ $message }}</p> @enderror
        </div>

        <div>
            <label>Email:</label><br>
            <input type="email" name="email" value="{{ old('email') }}">
            @error('email') <p style="color:red">{{ $message }}</p> @enderror
        </div>

        <div>
            <label>Пароль:</label><br>
            <input type="password" name="password">
            @error('password') <p style="color:red">{{ $message }}</p> @enderror
        </div>

        <br>
        <button type="submit">Зарегистрироваться</button>
    </form>

@endsection