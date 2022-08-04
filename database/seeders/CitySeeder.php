<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::factory()
            ->count(4)
            ->state(new Sequence(
                ['title' => 'Київ'],
                ['title' => 'Дніпро'],
                ['title' => 'Запоріжжя'],
                ['title' => 'Львів'],
                ['title' => 'Харків']
            ))
            ->create();
    }
}
