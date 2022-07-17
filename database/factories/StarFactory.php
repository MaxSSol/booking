<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $count = $this->faker->randomElement([0,2,3,4,5]);
        $titles = [
            '0' => 'Без зіркової категорії',
            '2' => '2 зірки',
            '3' => '3 зірки',
            '4' => '4 зірки',
            '5' => '5 зірок'
        ];
        return [
            'count' => $count,
            'title' => $titles[$count]
        ];
    }
}
