<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TasksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'title' => $this->faker->word,
            'description' => $this->faker->word,
            'initialDate' => $this->faker->date(), // Data inicial no formato YYYY-MM-DD
            'expectedFinalDate' => $this->faker->date(), // Data esperada final no formato YYYY-MM-DD
            'finalDate' => $this->faker->optional()->date(), // Data final opcional
            'status' => 1,
        ];
    }
}
