<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExamFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'category' => $this->faker->randomElement(['Math', 'Science', 'History', 'English']),
            'duration' => $this->faker->numberBetween(30, 120),
        ];
    }
}
