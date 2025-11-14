@extends('layouts.app')
@section('content')
@if($article)
    <h1>{{ $article['name'] }}</h1>

    @if(isset($article['full_images']) && is_array($article['full_images']))
        @foreach($article['full_images'] as $image)
            <div style="margin-bottom: 20px;">
                <img src="{{ asset($image) }}" alt="{{ $article['name'] }}" style="max-width: 600px;">
            </div>
        @endforeach
    @else
        <img src="{{ asset($article['full_image']) }}" alt="{{ $article['name'] }}">
    @endif

    <p>{{ $article['desc'] }}</p>
@else
    <p>Новость не найдена</p>
@endif
@endsection