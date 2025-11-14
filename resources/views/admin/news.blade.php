@extends('layouts.app')
@section('content')
<h1>Админка: Новости</h1>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('admin.store') }}">
    @csrf
    <label>Название:</label>
    <input type="text" name="name" required><br>

    <label>Краткое описание:</label>
    <input type="text" name="shortDesc"><br>

    <label>Описание:</label>
    <textarea name="desc"></textarea><br>

    <button type="submit">Добавить</button>
</form>

<hr>
<h2>Список новостей</h2>
<ul>
@foreach($articles as $article)
    <li>{{ $article['date'] }} — {{ $article['name'] }}</li>
@endforeach
</ul>
@endsection