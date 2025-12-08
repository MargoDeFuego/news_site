<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = \App\Models\Article::paginate(10); // пагинатор
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        // Проверка политики: только модератор
        $this->authorize('create', Article::class);

        return view('articles.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Article::class);

        Article::create($request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]));

        return redirect()->route('articles.index');
    }

    public function edit(Article $article)
    {
        $this->authorize('update', $article);

        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        $article->update($request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]));

        return redirect()->route('articles.index');
    }

    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        $article->delete();

        return redirect()->route('articles.index');
    }

    public function show(\App\Models\Article $article)
    {
    return view('articles.show', compact('article'));
    }

}
