<?php

namespace Database\Seeders;

use App\Models\Accommodation;
use App\Models\RentRequest;
use App\Models\User;
use Illuminate\Database\Seeder;

class RentRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::all()->first();
        RentRequest::factory()
            ->create([
                'user_id' => User::factory(),
                'accommodation_id' => Accommodation::all()->first(),
                'payment_method_id' => $user->paymentMethods()->first()
            ]);
    }
}
