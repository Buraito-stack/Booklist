<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rating;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class RatingSeeder extends Seeder
{
    public function run()
    {
        $batchSize = 100; 
        $total = 500000;  

        DB::transaction(function () use ($batchSize, $total) {
            for ($i = 0; $i < $total; $i += $batchSize) {
                $bookIds = Book::inRandomOrder()->limit($batchSize)->pluck('id');

                $ratings = $bookIds->map(function ($bookId) {
                    return [
                        'book_id'    => $bookId,
                        'rating'     => rand(1, 10),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                })->toArray();

                DB::table('ratings')->insert($ratings);
                $this->command->info("Seeded " . ($i + $batchSize) . "/$total ratings");
            }
        });
    }
}
