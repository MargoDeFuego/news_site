@extends('layouts.app')

@section('content')
    <h1>Личный кабинет</h1>
    <p>Добро пожаловать, {{ auth()->user()->name }}!</p>

    <form action="{{ route('auth.logout') }}" method="POST">
        @csrf
        <button type="submit">Выйти</button>
    </form>
@endsection