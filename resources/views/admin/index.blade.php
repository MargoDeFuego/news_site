@extends('layouts.app')
@section('content')
<h1>Админка</h1>

@can('manage-users')
    <li><a href="{{ route('admin.users.index') }}">Пользователи</a></li>
@endcan

<ul>
    <li><a href="{{ route('admin.news') }}">Управление новостями</a></li>
    <li><a href="{{ route('admin.gallery') }}">Управление галереей</a></li>
</ul>
@endsection