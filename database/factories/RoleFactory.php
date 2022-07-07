<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $slug = $this->faker->randomElement(['admin', 'publisher']);
        $titles = ['admin' => 'Адміністратор', 'publisher' => 'Видавець'];
        return [
            'slug' => $slug,
            'title' => $titles[$slug]
        ];
    }
}
