<?php

namespace Database\Seeders;

use App\Models\Accommodation;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()
            ->count(3)
            ->hasAttached(Accommodation::all()->first())
            ->create();
    }
}
