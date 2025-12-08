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
        return in_array($user->role->name, ['reader', 'moderator']);
    }

    /**
     * Разрешаем удаление комментариев только модератору
     */
    public function delete(User $user, Comment $comment): bool
    {
        return $user->role->name === 'moderator';
    }

    /**
     * Разрешаем редактирование комментариев:
     * - модератор может редактировать любые
     * - читатель только свои
     */
    public function update(User $user, Comment $comment): bool
    {
        return $user->role->name === 'moderator'
            || ($user->role->name === 'reader' && $user->id === $comment->user_id);
    }
}
