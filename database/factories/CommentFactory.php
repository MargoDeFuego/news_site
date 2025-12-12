<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'user_id'    => User::inRandomOrder()->first()->id ?? User::factory(),
            'article_id' => Article::inRandomOrder()->first()->id ?? Article::factory(),
            'content'    => $this->faker->paragraph(),
        ];
    }
}
