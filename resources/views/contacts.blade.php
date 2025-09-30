@extends('layouts.app')
@section('content')

        <section>
            <article>
                <h1>Контакты</h1>
                <div>
                    <p>Мы находимся в Подольске.</p>
                </div>
                <ul>
                    @foreach($contacts as $key => $value)
                    <li>{{$key}}: {{$value}}</li>
                    @endforeach
                </ul>
            </article>
        </section>
@endsection