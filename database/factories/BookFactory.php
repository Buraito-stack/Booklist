<?php
namespace Database\Factories;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3),
            'category_id' => Category::factory(),
            'author_id' => Author::factory(),
            'average_rating' => $this->faker->numberBetween(1, 10),
            'voter' => $this->faker->numberBetween(1, 1000),
        ];
    }
}

