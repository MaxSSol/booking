<?php

namespace Database\Seeders;

use App\Models\Accommodation;
use App\Models\Category;
use App\Models\City;
use App\Models\Opportunity;
use App\Models\RentInfo;
use App\Models\Star;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Nette\Utils\Random;

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
            ->count(100)
            ->hasAttached(Category::all()->random())
            ->hasAttached(Opportunity::all()->random())
            ->state(new Sequence(
                fn($sequence) => [
                    'city_id' => City::all()->random(),
                    'star_id' => Star::all()->random(),
                    'user_id' => User::all()->random()
                ]
            ))
            ->create();
    }
}
