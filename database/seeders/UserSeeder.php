<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(50)
            ->hasAttached(PaymentMethod::factory()->count(2), [
                'bill_number' => rand(4000000000000000, 5000000000000000)
            ])
            ->create();
    }
}
