<?php

namespace Tests\Feature;

use App\Models\Accommodation;
use App\Models\Category;
use App\Models\City;
use App\Models\Opportunity;
use App\Models\Star;
use App\Models\User;
use Faker\Provider\Address;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccommodationTest extends TestCase
{
    use DatabaseMigrations;

    protected $accommodation;
    protected function setUp(): void
    {
        parent::setUp();
        User::factory()->create();
        Star::factory()->create();
        City::factory()->create();
        $this->accommodation = Accommodation::factory()
            ->create([
                'user_id' => User::all()->first(),
                'star_id' => Star::all()->random(),
                'city_id' => City::all()->random()
            ]);
    }

    public function test_get_accommodation()
    {
        $response = $this->get('/api/accommodation');

        $response->assertStatus(200);

        $response->assertJsonPath('data.0.id', $this->accommodation->id);
    }

    public function test_show_accommodation_by_id()
    {
        $response = $this->get('/api/accommodation/' . $this->accommodation->id);

        $response->assertStatus(200);

        $response->assertJsonPath('data.0.id', $this->accommodation->id);
    }

    public function test_store_accommodation_with_wrong_data()
    {
        $accommodationData = [
            'title' => 'test',
            'description' => 'test/test/test',
            'number_of_rooms' => 15,
            'number_of_floors' => 1,
            'address' => 'test',
            'city_id' => '',
            'star_id' => '',
            'category_id' => '',
            'opportunity_id' => '',
        ];

        $response = $this->actingAs(User::all()->random())->post('/api/user/accommodation', $accommodationData);

        $response->assertStatus(302);
    }

    public function test_store_accommodation()
    {
        $category = Category::factory()->create();
        $opportunity = Opportunity::factory()->create();
        $city = City::all()->random();
        $star = Star::all()->random();
        $accommodationData = [
            'title' => 'test',
            'description' => 'test/test/test',
            'number_of_rooms' => 15,
            'number_of_floors' => 1,
            'address' => 'test',
            'city_id' => $city->id,
            'star_id' => $star->id,
            'category_id' => [$category->id],
            'opportunity_id' => [$opportunity->id],
        ];

        $response = $this->actingAs(User::all()->random())->post('/api/user/accommodation', $accommodationData);

        $response->assertJsonPath('accommodation.title', 'test');
        $response->assertStatus(200);
    }
}
