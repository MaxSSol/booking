<?php

namespace Database\Seeders;

use App\Models\Accommodation;
use App\Models\AccommodationUnit;
use App\Models\Facility;
use App\Models\RentInfo;
use Illuminate\Database\Eloquent\Factories\Sequence;
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
            ->count(200)
            ->hasAttached(Facility::all()->random())
            ->state(new Sequence(
                fn($sequence) => [
                    'rent_info_id' => RentInfo::all()->random(),
                    'accommodation_id' => Accommodation::all()->random()
                ]
            ))
            ->create();
    }
}
