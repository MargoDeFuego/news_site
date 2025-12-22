<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{
    /**
     * GET /api/news
     * index — кэшируем список статей + пагинацию (remember)
     */
    public function index(Request $request)
    {
        $page = $request->get('page', 1);

        $articles = Cache::remember(
            "api_articles_page_{$page}",
            now()->addMinutes(10),
            function () {
                return Article::paginate(10);
            }
        );

        return response()->json([
            'data' => $articles,
        ]);
    }

    /**
     * GET /api/news/{article}
     * show — кэшируем статью + комментарии (rememberForever)
     */
    public function show(Article $article)
    {
        $cacheKey = "api_article_{$article->id}_with_comments";

        $article = Cache::rememberForever($cacheKey, function () use ($article) {
            return Article::with([
                'comments' => fn ($q) => $q->approved()->with('user'),
            ])->findOrFail($article->id);
        });

        return response()->json([
            'data' => $article,
        ]);
    }

    /**
     * POST /api/news
     * store — создаём статью, чистим кэш
     */
    public function store(Request $request)
    {
        $this->authorize('create', Article::class);

        $article = Article::create($request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]));

        Cache::flush();

        return response()->json([
            'message' => 'Новость создана',
            'data'    => $article,
        ], 201);
    }

    /**
     * PUT /api/news/{article}
     * update — обновляем статью, чистим кэш
     */
    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        $article->update($request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]));

        Cache::flush();

        return response()->json([
            'message' => 'Новость обновлена',
            'data'    => $article,
        ]);
    }

    /**
     * DELETE /api/news/{article}
     * destroy — удаляем статью, чистим кэш
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        $article->delete();

        Cache::flush();

        return response()->json([
            'message' => 'Новость удалена',
        ]);
    }
}
