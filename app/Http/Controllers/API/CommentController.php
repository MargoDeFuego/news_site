<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * POST /api/comments
     * Сохранение нового комментария
     */
    public function store(Request $request)
    {
        // Проверка прав: читатель и модератор могут добавлять комментарии
        $this->authorize('create', Comment::class);

        $validated = $request->validate([
            'content'    => 'required|string|max:500',
            'article_id' => 'required|exists:articles,id',
        ]);

        $comment = Comment::create([
            'user_id'     => $request->user()->id,
            'article_id'  => $validated['article_id'],
            'content'     => $validated['content'],
            'is_approved' => false,
        ]);

        return response()->json([
            'message' => 'Комментарий отправлен и ожидает модерации',
            'data'    => $comment,
        ], 201);
    }

    /**
     * PUT /api/comments/{comment}
     * Обновление комментария
     */
    public function update(Request $request, Comment $comment)
    {
        // Проверка прав: модератор или автор комментария
        $this->authorize('update', $comment);

        $validated = $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $comment->update([
            'content' => $validated['content'],
        ]);

        return response()->json([
            'message' => 'Комментарий обновлён',
            'data'    => $comment,
        ]);
    }

    /**
     * DELETE /api/comments/{comment}
     * Удаление комментария
     */
    public function destroy(Comment $comment)
    {
        // Проверка прав: удалить может только модератор
        $this->authorize('delete', $comment);

        $comment->delete();

        return response()->json([
            'message' => 'Комментарий удалён',
        ]);
    }
}
