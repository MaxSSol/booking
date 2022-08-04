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
            'title' => $this->faker->city() . ' Hotel',
            'description' => $this->faker->realText(),
            'number_of_rooms' => $this->faker->numberBetween(10,20),
            'number_of_floors' => $this->faker->numberBetween(1,9),
            'address' => $this->faker->address(),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
