<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
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
                'hotel',
                'apartment',
                'hostel',
                'guest_house'
            ]
        );
        $titles = [
            'hotel' => 'Готель',
            'apartment' => 'Апартаменти',
            'hostel' => 'Хостел',
            'guest_house' => 'Гостьовий будинок'
        ];

        return [
            'slug' => $slug,
            'title' => $titles[$slug]
        ];
    }
}
