<?php

namespace Database\Seeders;

use App\Models\Star;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class StarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Star::factory()
            ->count(5)
            ->state(new Sequence(
                ['count' => '0', 'title' => 'Без зіркової категорії'],
                ['count' => '2', 'title' => '2 зірки'],
                ['count' => '3', 'title' => '3 зірки'],
                ['count' => '4', 'title' => '4 зірки'],
                ['count' => '5', 'title' => '5 зірок'],
            ))
            ->create();
    }
}
