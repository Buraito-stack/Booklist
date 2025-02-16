<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'name'           => $this->faker->sentence,
            'category_id'    => Category::inRandomOrder()->first()->id,
            'author_id'      => Author::inRandomOrder()->first()->id,
            'average_rating' => Book::inrandomFloat(1, 1, 10)->id,
            'voter'          => 0, 
            'created_at'     => now(),
            'updated_at'     => now(),
        ];
    }
}
