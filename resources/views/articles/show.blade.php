@extends('layouts.app')

@section('content')
    <h2>{{ $article->title }}</h2>
    <p>{{ $article->desc }}</p>
    <small>{{ $article->date }}</small>

    <hr>

    {{-- Список комментариев --}}
    <h4>Комментарии:</h4>
    @forelse($article->comments as $comment)
        <div class="comment mb-3">
            <strong>{{ $comment->user->name }}</strong>
            <p>{{ $comment->content }}</p>

            {{-- Кнопки редактирования и удаления --}}
            @can('update', $comment)
                <form method="POST" action="{{ route('comments.update', $comment->id) }}">
                    @csrf
                    @method('PUT')
                    <textarea name="content" class="form-control">{{ $comment->content }}</textarea>
                    <button type="submit" class="btn btn-warning mt-2">Редактировать</button>
                </form>
            @endcan

            @can('delete', $comment)
                <form method="POST" action="{{ route('comments.destroy', $comment->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mt-2">Удалить</button>
                </form>
            @endcan
        </div>
    @empty
        <p>Комментариев пока нет.</p>
    @endforelse

    <hr>

    {{-- Форма добавления комментария --}}
    @auth
        @can('create', App\Models\Comment::class)
            <form method="POST" action="{{ route('comments.store') }}">
                @csrf
                <textarea name="content" class="form-control" required></textarea>
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <button type="submit" class="btn btn-primary mt-2">Оставить комментарий</button>
            </form>
        @endcan
    @else
        <p>Чтобы оставить комментарий, <a href="{{ route('auth.loginForm') }}">войдите</a>.</p>
    @endauth
@endsection
