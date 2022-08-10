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
            ->count(17)
            ->state(new Sequence(
                ['title' => 'Київ'],
                ['title' => 'Дніпро'],
                ['title' => 'Запоріжжя'],
                ['title' => 'Львів'],
                ['title' => 'Харків'],
                ['title' => 'Одеса'],
                ['title' => 'Кривий Ріг'],
                ['title' => 'Миколаїв'],
                ['title' => 'Вінниця'],
                ['title' => 'Хмельницький'],
                ['title' => 'Чернігів'],
                ['title' => 'Полтава'],
                ['title' => 'Рівне'],
                ['title' => 'Тернопіль'],
                ['title' => 'Кропивницький'],
                ['title' => 'Кам\'янське'],
                ['title' => 'Івано-Франківськ'],
            ))
            ->create();
    }
}
