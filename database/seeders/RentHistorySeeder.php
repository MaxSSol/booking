<?php

namespace Database\Seeders;

use App\Models\AccommodationUnit;
use App\Models\PaymentMethod;
use App\Models\RentHistory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class RentHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accommodationUnit = AccommodationUnit::all()->random();
        RentHistory::factory()
            ->count(100)
            ->state(new Sequence(
               fn($sequence) => [
                    'user_id' => User::all()->random(),
                    'accommodation_unit_id' => $accommodationUnit->id,
                    'payment_method_id' => $accommodationUnit->user->paymentMethods->first()->id
               ]
            ))
            ->create();
    }
}
