@extends('layouts.app')
@section('content')
<h1>Админка</h1>

<ul>
    <li><a href="{{ route('admin.news') }}">Управление новостями</a></li>
    <li><a href="{{ route('admin.gallery') }}">Управление галереей</a></li>
</ul>
@endsection