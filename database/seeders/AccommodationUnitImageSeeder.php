<?php

namespace Database\Seeders;

use App\Models\AccommodationUnit;
use App\Models\AccommodationUnitImage;
use Illuminate\Database\Seeder;

class AccommodationUnitImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccommodationUnitImage::factory()
            ->create([
                'accommodation_unit_id' => AccommodationUnit::all()->first()
            ]);
    }
}
