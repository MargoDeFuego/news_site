<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Сначала создаём роли
        $this->call(RoleSeeder::class);

        // Создаём модератора
        User::factory()->create([
            'name' => 'Moderator User',
            'email' => 'moderator@example.com',
            'role_id' => 1, // moderator
        ]);

        // Создаём читателя
        User::factory()->create([
            'name' => 'Reader User',
            'email' => 'reader@example.com',
            'role_id' => 2, // reader
        ]);

        // Тестовый пользователь (по умолчанию reader)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role_id' => 2,
        ]);

        // Создаём статьи
        $articles = Article::factory(10)->create();

        // Создаём комментарии для каждой статьи
        $articles->each(function ($article) {
            Comment::factory(rand(2, 6))->create([
                'article_id' => $article->id,
                'user_id'    => User::inRandomOrder()->first()->id,
            ]);
        });
    }
}
