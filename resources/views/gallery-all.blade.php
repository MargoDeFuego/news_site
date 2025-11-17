@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Галерея</h1>

    <div class="row">
        @forelse ($images as $img)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <a href="{{ route('gallery.item', $loop->index) }}" style="text-decoration:none; color:inherit;">
                    <img src="{{ asset($img['path']) }}" class="card-img-top" alt="{{ $img['title'] }}" width="150" height="100">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $img['title'] }}</h5>
                        @if (!empty($img['desc']))
                            <p class="card-text">{{ $img['desc'] }}</p>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p>Галерея пока пуста.</p>
        @endforelse
    </div>
</div>
@endsection