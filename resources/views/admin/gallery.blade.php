@extends('layouts.app')
@section('content')
<h1>Админка: Галерея</h1>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
    @csrf
    <label>Название:</label>
    <input type="text" name="title" required><br>

    <label>Выберите изображение:</label>
    <input type="file" name="image" accept="image/*" required><br>

    <label>Описание:</label>
    <textarea name="desc"></textarea><br>

    <button type="submit">Добавить изображение</button>
</form>

<hr>
<h2>Список изображений</h2>
<ul>
@foreach($images as $image)
    <li>
        {{ $image['title'] }} — <img src="{{ asset($image['path']) }}" width="100">
    </li>
@endforeach
</ul>
@endsection