<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AccommodationCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $rating = collect([
            'location' => $this->faker->numberBetween(7, 10),
            'facilities' => $this->faker->numberBetween(6, 10),
            'service' => $this->faker->numberBetween(6, 10),
            'price' => $this->faker->numberBetween(7, 10)
        ]);

        return [
            'comment' => $this->faker->sentence(),
            'total_rating' => floor($rating->avg()),
            'location' => $rating['location'],
            'facilities' => $rating['facilities'],
            'service' => $rating['service'],
            'price' => $rating['price']
        ];
    }
}
