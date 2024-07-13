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
            'book_id' => Book::factory()->create()->id, 
            'rating' => $this->faker->numberBetween(1, 10),
        ];
    }
}
