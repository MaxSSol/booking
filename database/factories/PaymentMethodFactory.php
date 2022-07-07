<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $slug = $this->faker->randomElement(['portmone', 'google_pay', 'master_card', 'visa', 'cash']);

        $titles = [
            'portmone' => 'Портмоне',
            'google_pay' => 'Google Pay',
            'master_card' => 'Картка Master Card',
            'visa' => 'Картка Visa',
            'cash' => 'Готівка'
        ];

        return [
            'slug' => $slug,
            'title' => $titles[$slug],
            'image' => $this->faker->imageUrl(80,80, 'payment')
        ];
    }
}
