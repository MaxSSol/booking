<?php

namespace Database\Seeders;

use App\Models\Accommodation;
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
        Facility::factory()
            ->count(3)
            ->hasAttached(Accommodation::all()->first())
            ->create();
    }
}
