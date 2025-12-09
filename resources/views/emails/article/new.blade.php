<x-mail::message>
# Новая статья опубликована

Здравствуйте! На сайте добавлена новая статья.

## {{ $article->title }}

{{ $article->desc }}

**Дата публикации:** {{ $article->date }}

<x-mail::button :url="route('news.show', $article->id)">
Посмотреть статью
</x-mail::button>

Спасибо,<br>
{{ config('app.name') }}
</x-mail::message>
