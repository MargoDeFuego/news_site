<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Сохранение нового комментария
     */
    public function store(Request $request)
    {
        // Проверка прав: читатель и модератор могут добавлять комментарии
        $this->authorize('create', Comment::class);

        $request->validate([
            'content' => 'required|string|max:500',
            'article_id' => 'required|exists:articles,id',
        ]);

        Comment::create([
            'user_id'    => auth()->id(),
            'article_id' => $request->article_id,
            'content'    => $request->content,
        ]);

        return back()->with('success', 'Комментарий добавлен!');
    }

    /**
     * Обновление комментария
     */
    public function update(Request $request, Comment $comment)
    {
        // Проверка прав: модератор или автор комментария
        $this->authorize('update', $comment);

        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $comment->update([
            'content' => $request->content,
        ]);

        return back()->with('success', 'Комментарий обновлён!');
    }

    /**
     * Удаление комментария
     */
    public function destroy(Comment $comment)
    {
        // Проверка прав: удалить может только модератор
        $this->authorize('delete', $comment);

        $comment->delete();

        return back()->with('success', 'Комментарий удалён!');
    }
}
