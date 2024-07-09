<?php

namespace Database\Seeders;

use App\Models\AuthorBook;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            Book::create([
                'title' => fake()->title,
                'description' => fake()->text,
                'publication_year' => fake()->year,
            ]);
        }



    }
}
