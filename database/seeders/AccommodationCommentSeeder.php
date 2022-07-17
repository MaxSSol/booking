<?php

namespace Database\Seeders;

use App\Models\Accommodation;
use App\Models\AccommodationComment;
use App\Models\AccommodationUnit;
use App\Models\RentHistory;
use App\Models\User;
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
        $rentHistory = RentHistory::all()->first();
        AccommodationComment::factory()
            ->create([
                'user_id' => $rentHistory->user->id,
                'accommodation_id' => Accommodation::all()->first(),
                'accommodation_unit_id' => AccommodationUnit::all()->random()
            ]);
    }
}
