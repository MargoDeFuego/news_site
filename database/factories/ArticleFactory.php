<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'title' => $this->faker->realText(30),
        'preview_image' => 'images/default_prev.jpg',
        'full_image' => 'images/default_full.jpg',
        'date' => $this->faker->date('Y-m-d'),
        'shortDesc' => $this->faker->realText(60),
        'desc' => $this->faker->realTextBetween(200, 600),
    ];
}
}