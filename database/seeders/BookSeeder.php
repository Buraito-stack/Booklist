<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    public function run()
    {
        // Ambil semua authors dan categories dengan eager loading
        $authors = Author::all();
        $categories = Category::all();

        // Buat instance faker
        $faker = Faker::create();

        // Batasi ukuran batch
        $batchSize = 1000;
        $total = 100000; // Total data yang akan dimasukkan

        // Mengisi tabel books dengan data menggunakan factory
        for ($i = 0; $i < $total; $i += $batchSize) {
            $books = [];
            for ($j = 0; $j < $batchSize; $j++) {
                $books[] = [
                    'name' => $faker->sentence(3),
                    'category_id' => $categories->random()->id,
                    'author_id' => $authors->random()->id,
                    'average_rating' => $faker->randomFloat(1, 1, 10),
                    'voter' => $faker->numberBetween(1, 1000),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            // Insert data ke tabel books
            DB::table('books')->insert($books);

            // Bersihkan cache agar memori tidak menumpuk
            gc_collect_cycles();
        }
    }
}
