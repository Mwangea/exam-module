<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    public function definition()
    {
        return [
            'question_text' => $this->faker->sentence() . '?',
        ];
    }
}
