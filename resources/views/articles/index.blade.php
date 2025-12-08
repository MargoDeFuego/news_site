@extends('layouts.app')

@section('content')
    <h1>Новости</h1>

    @foreach($articles as $article)
        <h3>
            <a href="{{ route('news.show', $article->id) }}">
                {{ $article->title }}
            </a>
        </h3>
        <p>{{ $article->shortDesc }}</p>
        <small>{{ $article->date }}</small>  
        <hr>
    @endforeach

    <div class="pagination">{{ $articles->links() }}</div>
@endsection
