<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            Author::create([
                'first_name' => fake()->firstName,
                'last_name' => fake()->lastName,
                'biography' => fake()->realText()
            ]);
        }

    }
}
