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
           PaymentMethodSeeder::class,
           RentInfoSeeder::class,
           CitySeeder::class,
           AccommodationSeeder::class,
           AccommodationUnitSeeder::class,
           OpportunitySeeder::class,
           CategorySeeder::class,
           FacilitySeeder::class,
           AccommodationImageSeeder::class,
           AccommodationUnitImageSeeder::class,
           RentHistorySeeder::class,
           AccommodationCommentSeeder::class,
        ]);
    }
}
