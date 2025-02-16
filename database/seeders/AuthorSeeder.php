<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Log;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create(); 
        $batchSize = 1000;
        $total = 1000; 
        Log::info("Starting AuthorSeeder...");

        for ($i = 0; $i < $total; $i += $batchSize) {
            $authors = [];
            for ($j = 0; $j < $batchSize; $j++) {
                $authors[] = [
                    'name' => $faker->name,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            Author::insert($authors);
            Log::info("Seeded " . ($i + $batchSize) . "/$total authors");
        }

        Log::info("Finished AuthorSeeder.");
    }
}
