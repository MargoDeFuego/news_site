<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Article $article)
    {
        // Читатель и модератор могут добавлять комментарии
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $article->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return back();
    }

    public function destroy(Comment $comment)
    {
        // Проверка политики: удалить может только модератор
        $this->authorize('delete', $comment);

        $comment->delete();

        return back();
    }
}
