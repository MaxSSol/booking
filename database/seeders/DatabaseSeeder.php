<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            RentInfoSeeder::class,
            CitySeeder::class,
            StarSeeder::class,
            OpportunitySeeder::class,
            CategorySeeder::class,
            FacilitySeeder::class,
            AccommodationSeeder::class,
            AccommodationUnitSeeder::class,
            AccommodationImageSeeder::class,
            AccommodationUnitImageSeeder::class,
            RentHistorySeeder::class,
            AccommodationCommentSeeder::class,
        ]);
    }
}
