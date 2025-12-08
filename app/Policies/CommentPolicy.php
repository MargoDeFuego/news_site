<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;

class CommentPolicy
{
    /**
     * Разрешаем создание комментариев
     */
    public function create(User $user): bool
    {
        // Читатель и модератор могут оставлять комментарии
        return $user->role === 'reader' || $user->role === 'moderator';
    }

    /**
     * Разрешаем удаление комментариев только модератору
     */
    public function delete(User $user, Comment $comment): bool
    {
        return $user->role === 'moderator';
    }

    /**
     * Разрешаем редактирование комментариев:
     * - модератор может редактировать любые
     * - читатель только свои
     */
    public function update(User $user, Comment $comment): bool
    {
        return $user->role === 'moderator'
            || ($user->role === 'reader' && $user->id === $comment->user_id);
    }
}
