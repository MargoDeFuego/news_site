@extends('layouts.app')

@section('content')

    <h2>{{ $article->title }}</h2>

    {{-- Flash-сообщение об успехе --}}
    @if (session('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
    @endif

    {{-- Ошибки валидации --}}
    @if ($errors->any())
        <div class="alert alert-danger mb-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Кнопка для модератора --}}
    @can('update', $article)
        <a href="{{ route('admin.news.edit', $article->id) }}" class="btn btn-warning mb-3">
            Редактировать новость
        </a>
    @endcan

    <p>{{ $article->desc }}</p>
    <small>{{ $article->date }}</small>

    <hr>

    {{-- Список комментариев --}}
    <h4>Комментарии:</h4>

    @forelse($article->comments as $comment)
        <div class="comment mb-3 p-2 border rounded">

            <strong>{{ $comment->user->name }}</strong>
            <p class="mb-1">{{ $comment->content }}</p>

            {{-- РЕДАКТИРОВАНИЕ (ПО КНОПКЕ) --}}
            @can('update', $comment)
                <details class="mt-2">
                    <summary class="btn btn-sm btn-warning">
                        Редактировать
                    </summary>

                    <form method="POST"
                          action="{{ route('comments.update', $comment->id) }}"
                          class="mt-2">
                        @csrf
                        @method('PUT')

                        <textarea name="content"
                                  class="form-control"
                                  rows="3"
                                  required>{{ old('content', $comment->content) }}</textarea>

                        <button type="submit" class="btn btn-warning btn-sm mt-2">
                            Сохранить
                        </button>
                    </form>
                </details>
            @endcan

            {{-- УДАЛЕНИЕ --}}
            @can('delete', $comment)
                <form method="POST"
                      action="{{ route('comments.destroy', $comment->id) }}"
                      class="mt-2">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger btn-sm">
                        Удалить
                    </button>
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

            <h5>Добавить комментарий</h5>

            <form method="POST" action="{{ route('comments.store') }}">
                @csrf

                <textarea name="content"
                          class="form-control"
                          rows="3"
                          required>{{ old('content') }}</textarea>

                <input type="hidden"
                       name="article_id"
                       value="{{ $article->id }}">

                <button type="submit" class="btn btn-primary mt-2">
                    Оставить комментарий
                </button>
            </form>

        @endcan
    @else
        <p>
            Чтобы оставить комментарий,
            <a href="{{ route('login') }}">войдите</a>.
        </p>
    @endauth

@endsection
