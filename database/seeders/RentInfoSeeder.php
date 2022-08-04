<?php

namespace Database\Seeders;

use App\Models\RentInfo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class RentInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RentInfo::factory()
            ->count(50)
            ->state(new Sequence(
                fn($sequence) => ['user_id' => User::all()->random()]
            ))
            ->create();
    }
}
