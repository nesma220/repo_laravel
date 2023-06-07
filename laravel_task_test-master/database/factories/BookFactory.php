<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'author' => $this->faker->name,
            'publication_date' => $this->faker->date,
            'description' => $this->faker->paragraph,
            'category' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
