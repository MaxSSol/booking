<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RentRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rent_date_from' => $this->faker->dateTimeBetween('-2 week', '-1 week'),
            'rent_date_to' => $this->faker->dateTimeBetween('-1 week'),
            'total_price' => $this->faker->numberBetween(4000,7000),
            'number_of_people' => $this->faker->numberBetween(1, 4),
            'check_status' => $this->faker->randomElement(['confirmed', 'rejected', 'unchecked']),
        ];
    }
}
