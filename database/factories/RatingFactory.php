<?php

namespace Database\Factories;

use App\Models\Rating;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    protected $model = Rating::class;

    public function definition()
    {
        return [
            'book_id' => Book::inRandomOrder()->first()->id, // Pastikan book_id valid
            'rating' => $this->faker->numberBetween(1, 10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
