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
        $freeTermination = $this->faker->boolean;
        return [
            'rent_for_short_term' => $this->faker->numberBetween(1, 5),
            'rent_for_long_term' => $this->faker->numberBetween(100,365),
            'free_termination' => $freeTermination,
            'leave_termination_price' => $freeTermination === true ? 0 : $this->faker->numberBetween(100,5000)
        ];
    }
}
