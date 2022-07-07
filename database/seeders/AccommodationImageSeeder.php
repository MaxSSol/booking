<?php

namespace Database\Seeders;

use App\Models\Accommodation;
use App\Models\AccommodationImage;
use Illuminate\Database\Seeder;

class AccommodationImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccommodationImage::factory()
            ->create(
                [
                    'accommodation_id' => Accommodation::all()->first()
                ]);
    }
}
