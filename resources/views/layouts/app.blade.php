<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новостной сайт</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/js/app.js'])
</head>
<body>
    <header>
    <nav>
        <ol>
            <li><a href="{{ route('home') }}">Главная</a></li>
            <li><a href="{{ route('about') }}">О нас</a></li>
            <li><a href="{{ route('contacts') }}">Контакты</a></li>
            <li><a href="{{ route('gallery.all') }}">Галерея</a></li>
            <li><a href="{{ route('news') }}">Новости</a></li>

            {{-- Авторизация / Личный кабинет --}}
            <li>
                @auth
                    <a href="{{ route('dashboard') }}">Личный кабинет</a>
                    <form method="POST" action="{{ route('auth.logout') }}">
                        @csrf
                        <button type="submit">Выйти</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Авторизация</a>
                @endauth
            </li>

            {{-- Создать новость — только модератор --}}
            <li>
                @can('create', App\Models\Article::class)
                    <a href="{{ route('admin.news') }}">Создать новость</a>

                @endcan
            </li>
            @auth
    @if(auth()->user()->isModerator())
        <li>
            <a href="{{ route('admin.comments') }}">
                Модерация комментариев
            </a>
        </li>
    @endif
@endauth
        </ol>
    </nav>
    </header>
    {{-- Vue-остров для уведомлений --}}
    <div id="notify-app" data-v-app="">
        <new-article-notify></new-article-notify>
    </div>
    <main>
        @yield('content')
    </main>

    <footer>
        <p>Малявкина Маргарита 241-321</p>
    </footer>
</body>
</html>