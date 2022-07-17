<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::factory()
            ->count(5)
            ->hasAttached(User::all()->first(), [
                'bill_number' => rand(4000000000000000, 5000000000000000)
            ])
            ->create();
    }
}
