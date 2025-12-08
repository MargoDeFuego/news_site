<?php

namespace Database\Seeders;

use App\Models\User;
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
        \App\Models\Article::factory(10)->create();
    }
}
