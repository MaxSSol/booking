<?php

namespace Database\Seeders;

use App\Models\Accommodation;
use App\Models\RentInfo;
use App\Models\User;
use Illuminate\Database\Seeder;

class AccommodationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Accommodation::factory()
            ->create([
                'user_id' => User::all()->first(),
                'rent_info_id' => RentInfo::all()->first()
            ]);
    }
}
