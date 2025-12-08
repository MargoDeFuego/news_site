@extends('layouts.app')

@section('content')
<h1>Новости</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Дата</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Превью</th>
        </tr>
    </thead>
    <tbody>
        @foreach($articles as $index => $article)
        <tr>
            <td>{{ $article['date'] }}</td>
            <td>{{ $article['name'] }}</td>
            <td>{{ $article['desc'] }}</td>
            <td>
                <img src="{{ asset($article['preview_image']) }}" width="100">
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- Ссылка на личный кабинет --}}
@auth
    <div class="mt-4">
        <a href="{{ route('dashboard') }}" class="btn btn-primary">Перейти в личный кабинет</a>
    </div>
@else
    <div class="mt-4">
        <p>
            <a href="{{ route('auth.loginForm') }}" class="btn btn-success">Войти</a>
            или <a href="{{ route('auth.create') }}" class="btn btn-outline-secondary">Зарегистрироваться</a>
        </p>
    </div>
@endauth
@endsection
