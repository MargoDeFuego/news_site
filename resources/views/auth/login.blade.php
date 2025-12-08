@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 400px;">
    <h2 class="mb-4 text-center">Вход в систему</h2>

    {{-- Сообщения об ошибках --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Сообщение об успехе --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('auth.login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" class="form-control" required value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input id="password" type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Войти</button>
    </form>

    <p class="mt-3 text-center">
        Нет аккаунта? <a href="{{ route('auth.create') }}">Зарегистрироваться</a>
    </p>
</div>
@endsection
