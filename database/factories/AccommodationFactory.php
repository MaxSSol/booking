<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AccommodationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->realText(),
            'number_of_rooms' => $this->faker->numberBetween(1,5),
            'number_of_floors' => $this->faker->numberBetween(1,3),
            'square' => $this->faker->randomFloat(),
            'max_count_people' => $this->faker->numberBetween(1,5),
            'price' => $this->faker->numberBetween(1000,2500),
            'is_available' => $this->faker->boolean,
            'date_available_from' => $this->faker->date
        ];
    }
}
