<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1, 30),
            'topic_id' => fake()->numberBetween(1, 4),
            'title' => fake()->sentence,
            'lead' => fake()->sentences(4, true),
            'content' => fake()->paragraphs(8, true)
        ];
    }
}
