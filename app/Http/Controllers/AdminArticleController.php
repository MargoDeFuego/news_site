<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewArticleMail;
use App\Models\User;

class AdminArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.news.index', compact('articles'));
    }

public function store(Request $request)
{
    $request->validate([
        'title'      => 'required|min:3|max:255',
        'shortDesc'  => 'nullable|max:255',
        'desc'       => 'nullable|min:10',
    ]);

    // Создаём статью
    $article = Article::create([
        'title'        => $request->title,
        'shortDesc'    => $request->shortDesc,
        'desc'         => $request->desc,
        'date'         => now()->format('Y-m-d'),
        'preview_image'=> '',
        'full_image'   => '',
    ]);

    // Находим всех модераторов
    $moderators = User::whereHas('role', fn($q) => 
        $q->where('name', 'moderator')
    )->get();

    // Отправляем письма
    foreach ($moderators as $moderator) {
        Mail::to($moderator->email)->send(new NewArticleMail($article));
    }

    return redirect()
        ->route('admin.news')
        ->with('success', 'Новость добавлена и уведомление отправлено!');
}


    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('admin.news.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'      => 'required|min:3|max:255',
            'shortDesc'  => 'nullable|max:255',
            'desc'       => 'nullable|min:10',
        ]);

        Article::findOrFail($id)->update([
            'title'     => $request->title,
            'shortDesc' => $request->shortDesc,
            'desc'      => $request->desc,
        ]);

        return redirect()
            ->route('admin.news')
            ->with('success', 'Новость обновлена!');
    }

    public function destroy($id)
    {
        Article::findOrFail($id)->delete();

        return redirect()
            ->route('admin.news')
            ->with('success', 'Новость удалена!');
    }
}
