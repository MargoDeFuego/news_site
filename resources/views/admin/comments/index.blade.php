
@extends('layouts.app')

@section('content')
<h2>Комментарии на модерации</h2>

@forelse($comments as $comment)
    <div class="border p-3 mb-3">
        <strong>{{ $comment->user->name }}</strong>
        <p>{{ $comment->content }}</p>
        <small>Новость: {{ $comment->article->title }}</small>

        <form method="POST" action="{{ route('admin.comments.approve', $comment) }}">
            @csrf
            <button class="btn btn-success mt-2">Одобрить</button>
        </form>

        <form method="POST" action="{{ route('admin.comments.reject', $comment) }}">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger mt-2">Отклонить</button>
        </form>
    </div>
@empty
    <p>Нет комментариев на модерации.</p>
@endforelse
@endsection
