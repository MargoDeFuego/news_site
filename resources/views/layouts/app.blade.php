<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новостной сайт</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <ol>
                <li>
                    <a href="{{ route('home') }}">Главная</a>
                </li>
                <li>
                    <a href="{{ route('about') }}">О нас</a>
                </li>
                <li>
                    <a href="{{ route('contacts') }}">Контакты</a>
                </li>
                <li>
                    <a href="{{ route('gallery.all') }}">Галерея</a>
                </li>
                <li>
                    <a href="{{ route('auth.registration') }}">Авторизация</a>
                </li>
                <li>
                    <a href="{{ route('news') }}">Новости</a>
                </li>
            </ol>   
        </nav>
    </header>
    <main>
        @yield('content')  
    </main>
    <footer>
        <p>Малявкина Маргарита 241-321</p>
    </footer>
</body>
</html>