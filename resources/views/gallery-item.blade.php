@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ $image['title'] }}</h1>

    <div class="mb-4">
        <img src="{{ asset($image['path']) }}" class="img-fluid" alt="{{ $image['title'] }}">
    </div>

    @if (!empty($image['desc']))
        <p>{{ $image['desc'] }}</p>
    @endif

    <a href="{{ route('gallery.all') }}" class="btn btn-secondary">← Назад к галерее</a>
</div>
@endsection