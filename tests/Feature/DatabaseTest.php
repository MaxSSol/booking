<?php

namespace Tests\Feature;

use App\Models\Accommodation;
use App\Models\City;
use App\Models\Star;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
    use DatabaseMigrations;

    public function test_user_create()
    {
        User::factory()->count(10)->create();
        $this->assertDatabaseCount('users', 10);
    }

    public function test_accommodation_create()
    {
        User::factory()->create();
        Star::factory()->create();
        City::factory()->create();
        Accommodation::factory()
            ->create([
                'user_id' => User::all()->first(),
                'star_id' => Star::all()->random(),
                'city_id' => City::all()->random()
            ]);

        $this->assertDatabaseCount('accommodation', 1);
    }
}
