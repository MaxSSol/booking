<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RentInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rent_for_short_term' => $this->faker->numberBetween(1, 5),
            'rent_for_long_term' => $this->faker->numberBetween(100,365),
            'free_termination' => $this->faker->boolean,
            'leave_termination_price' => $this->faker->randomNumber()
        ];
    }
}
