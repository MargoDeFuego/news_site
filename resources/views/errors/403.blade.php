@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h1 class="display-4 text-danger">403</h1>
    <p class="lead">Доступ запрещён</p>
    <p>У вас нет прав для выполнения этого действия.</p>
    <a href="{{ route('home') }}" class="btn btn-primary mt-3">Вернуться на главную</a>
</div>
@endsection
