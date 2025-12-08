<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Moderator',
            'email' => 'moderator@example.com',
            'password' => Hash::make('password'),
            'role_id' => Role::where('name', 'moderator')->first()->id,
]);
    }
}
