<?php

namespace Database\Seeders;

use App\Models\Accommodation;
use App\Models\AccommodationComment;
use App\Models\AccommodationUnit;
use App\Models\RentHistory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class AccommodationCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        AccommodationComment::factory()
            ->count(500)
            ->state(new Sequence(
                fn($sequence) => [
                    'user_id' => User::all()->random(),
                    'accommodation_id' => Accommodation::all()->random(),
                    'accommodation_unit_id' => AccommodationUnit::all()->random()
                ]
            ))
            ->create();
    }
}
