@extends('layouts.app')

@section('content')
<h1>Редактировать новость</h1>

@if($errors->any())
    <ul style="color:red">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('admin.news.update', $article->id) }}">
    @csrf
    @method('PUT')

    <label>Название:</label>
    <input type="text" name="title" value="{{ $article->title }}" required><br>

    <label>Краткое описание:</label>
    <input type="text" name="shortDesc" value="{{ $article->shortDesc }}"><br>

    <label>Описание:</label>
    <textarea name="desc">{{ $article->desc }}</textarea><br>

    <button type="submit">Сохранить изменения</button>
</form>

<a href="{{ route('admin.news') }}">⬅️ Вернуться в админку</a>
@endsection
