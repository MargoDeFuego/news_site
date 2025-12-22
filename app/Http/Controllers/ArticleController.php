<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{
    /**
     * index — кэшируем список статей + пагинацию (remember)
     */
    public function index()
    {
        $page = request()->get('page', 1);

        $articles = Cache::remember(
            "articles_page_{$page}",
            now()->addMinutes(10),
            function () {
                return Article::paginate(10);
            }
        );

        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        // Проверка политики: только модератор
        $this->authorize('create', Article::class);

        return view('articles.create');
    }

    /**
     * store — после сохранения статьи очищаем кэш главной + пагинации
     */
    public function store(Request $request)
    {
        $this->authorize('create', Article::class);

        Article::create($request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]));

        // ❗ Чистим кэш списка статей и пагинации
        Cache::flush();

        return redirect()->route('articles.index');
    }

    public function edit(Article $article)
    {
        $this->authorize('update', $article);

        return view('articles.edit', compact('article'));
    }

    /**
     * update — чистим весь кэш
     */
    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        $article->update($request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]));

        Cache::flush();

        return redirect()->route('articles.index');
    }

    /**
     * destroy — чистим весь кэш
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        $article->delete();

        Cache::flush();

        return redirect()->route('articles.index');
    }

    /**
     * show — кэшируем страницу статьи + комментарии (rememberForever)
     */
    public function show(Article $article)
    {
        $cacheKey = "article_{$article->id}_with_comments";

        $article = Cache::rememberForever($cacheKey, function () use ($article) {
            return Article::with([
                'comments' => fn ($q) => $q->approved()->with('user'),
            ])->findOrFail($article->id);
        });

        return view('articles.show', compact('article'));
    }
}
