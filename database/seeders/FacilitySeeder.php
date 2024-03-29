<?php

namespace Database\Seeders;

use App\Models\AccommodationUnit;
use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Facility::factory()->count(5)->create();
    }
}
