<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FacilityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $slug = $this->faker->randomElement(
            [
                'free_wifi',
                'kitchen',
                'fitness',
            ]
        );
        $titles = [
            'free_wifi' => 'Безкоштовний WI-FI',
            'kitchen' => 'Кухня',
            'fitness' => 'Фітнес-центр',
        ];
        return [
            'slug' => $slug,
            'title' => $titles[$slug]
        ];
    }
}
