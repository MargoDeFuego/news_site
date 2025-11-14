@extends('layouts.app')
@section('content')
<h1>Новости</h1>
<table>
    <tr>
        <th>Дата</th>
        <th>Название</th>
        <th>Превью</th>
    </tr>
    @foreach($articles as $index => $article)
    <tr>
        <td>{{ $article['date'] }}</td>
        <td>{{ $article['name'] }}</td>
        <td>
            <a href="{{ route('gallery', $index) }}">
                <img src="{{ asset($article['preview_image']) }}" width="100">
            </a>
        </td>
    </tr>
    @endforeach
</table>
@endsection
