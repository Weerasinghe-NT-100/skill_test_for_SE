<?php

namespace Database\Factories;

use App\Models\BookCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookCategoryFactory extends Factory
{
    protected $model = BookCategory::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word, // Use $this->faker->word to generate a random word
        ];
    }
}