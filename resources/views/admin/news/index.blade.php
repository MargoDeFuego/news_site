@extends('layouts.app')

@section('content')
<h1>Админка: Новости</h1>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

@if($errors->any())
    <ul style="color:red">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('admin.store') }}">
    @csrf
    <label>Название:</label>
    <input type="text" name="title" required><br>

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
    <li>
        {{ $article->date }} — {{ $article->title }}

        <!-- Кнопка редактирования -->
        <a href="{{ route('admin.news.edit', $article->id) }}">✏️ Редактировать</a>

        <!-- Кнопка удаления -->
        <form action="{{ route('admin.news.delete', $article->id) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Удалить новость?')">🗑 Удалить</button>
        </form>
    </li>
@endforeach
</ul>
<div class="pagination">{{ $articles->links() }}</div>
@endsection