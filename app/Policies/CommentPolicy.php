<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;

class CommentPolicy
{
    /**
     * Разрешаем создание комментариев:
     * - reader может создавать
     * - moderator может создавать
     */
    public function create(User $user): bool
    {
        return in_array($user->role->name, ['reader', 'moderator']);
    }

    /**
     * Разрешаем удаление комментариев:
     * - moderator может удалять любые
     */
    public function delete(User $user, Comment $comment): bool
    {
        return $user->role->name === 'moderator';
    }

    /**
     * Разрешаем редактирование комментариев:
     * - moderator редактирует любые
     * - reader редактирует только свои
     */
    public function update(User $user, Comment $comment): bool
    {
        return $user->role->name === 'moderator'
            || ($user->role->name === 'reader' && $user->id === $comment->user_id);
    }
}
