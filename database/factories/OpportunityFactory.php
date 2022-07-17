<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OpportunityFactory extends Factory
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
                'swimming_pool',
                'parking',
                'massage',
            ]
        );
        $titles = [
            'swimming_pool' => 'Басейн',
            'parking' => 'Автостоянка',
            'massage' => 'Масаж',
        ];

        return [
            'slug' => $slug,
            'title' => $titles[$slug]
        ];
    }
}
