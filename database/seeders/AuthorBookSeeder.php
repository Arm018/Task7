<?php

namespace Database\Seeders;

use App\Models\AuthorBook;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 3; $i < 12; $i++) {
            DB::table('author_book')->insert([
                'author_id' => $i,
                'book_id' => $i,
            ]);

        }
    }
}
