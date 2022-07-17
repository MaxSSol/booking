<?php

namespace Database\Seeders;

use App\Models\Accommodation;
use App\Models\AccommodationUnit;
use App\Models\RentInfo;
use Illuminate\Database\Seeder;

class AccommodationUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccommodationUnit::factory()
            ->count(10)
            ->create([
                'rent_info_id' => RentInfo::all()->first(),
                'accommodation_id' => Accommodation::all()->first()
            ]);
    }
}
