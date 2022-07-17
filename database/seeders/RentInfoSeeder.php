<?php

namespace Database\Seeders;

use App\Models\RentInfo;
use App\Models\User;
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
            ->create(['user_id' => User::all()->first()]);
    }
}
