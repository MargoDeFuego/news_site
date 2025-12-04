@extends('layouts.app')
@section('content')
    <h1>Новости</h1>

    @foreach($articles as $article)
        <h3>{{ $article->title }}</h3>
        <p>{{ $article->shortDesc }}</p>
        <small>{{ $article->date }}</small>  
        <hr>
    @endforeach
    <div class="pagination">{{ $articles->links() }}</div>
@endsection 