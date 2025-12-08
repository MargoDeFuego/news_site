<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    /**
     * Все могут смотреть список статей.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Все могут смотреть конкретную статью.
     */
    public function view(?User $user, Article $article): bool
    {
        return true;
    }

    /**
     * Создавать статьи может только модератор.
     */
    public function create(User $user): bool
    {
        return $user->isModerator();
    }

    /**
     * Редактировать статьи может только модератор.
     */
    public function update(User $user, Article $article): bool
    {
        return $user->isModerator();
    }

    /**
     * Удалять статьи может только модератор.
     */
    public function delete(User $user, Article $article): bool
    {
        return $user->isModerator();
    }

    /**
     * Восстанавливать статьи может только модератор.
     */
    public function restore(User $user, Article $article): bool
    {
        return $user->isModerator();
    }

    /**
     * Удалять навсегда может только модератор.
     */
    public function forceDelete(User $user, Article $article): bool
    {
        return $user->isModerator();
    }
}
