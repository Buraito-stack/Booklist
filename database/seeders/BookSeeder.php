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
        $authors = Author::all();
        $categories = Category::all();

        $faker = Faker::create();

        $batchSize = 1000;
        $total = 100000;

        for ($i = 0; $i < $total; $i += $batchSize) {
            $books = [];
            for ($j = 0; $j < $batchSize; $j++) {
                $books[] = [
                    'name'           => $faker->sentence(3),
                    'category_id'    => $categories->random()->id,
                    'author_id'      => $authors->random()->id,
                    'average_rating' => $faker->randomFloat(1, 1, 10),
                    'voter'          => $faker->numberBetween(1, 1000),
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ];
            }
            DB::table('books')->insert($books);

            gc_collect_cycles();
        }
    }
}
