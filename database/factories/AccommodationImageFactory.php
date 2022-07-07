<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AccommodationImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image' => $this->faker->imageUrl(),
            'order' => $this->faker->numberBetween(1, 10)
        ];
    }
}
