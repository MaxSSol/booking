<?php

namespace Database\Seeders;

use App\Models\AccommodationUnit;
use App\Models\RentHistory;
use App\Models\User;
use Illuminate\Database\Seeder;

class RentHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RentHistory::factory()
            ->create(
                [
                    'user_id' => User::all()->random(),
                    'accommodation_unit_id' => AccommodationUnit::all()->random(),
                    'payment_method_id' => User::all()->first()
                ]
            );
    }
}
