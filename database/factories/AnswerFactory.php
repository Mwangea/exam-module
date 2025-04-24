<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    public function definition()
    {
        return [
            'answer_text' => $this->faker->sentence(),
            'is_correct' => false,
        ];
    }
}
