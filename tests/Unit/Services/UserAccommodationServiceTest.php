<?php

namespace Tests\Unit\Services;

use App\Http\Requests\StoreAccommodationRequest;
use App\Http\Requests\UpdateUserAccommodationRequest;
use App\Models\Accommodation;
use App\Models\Category;
use App\Models\City;
use App\Models\Opportunity;
use App\Models\Star;
use App\Models\User;
use App\Services\UserAccommodationService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserAccommodationServiceTest extends TestCase
{
    use DatabaseMigrations;

    protected UserAccommodationService $accommodationService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->accommodationService = new UserAccommodationService();
    }

    public function test_store_method_return_accommodation_id()
    {
        User::factory()->create();
        $city = City::factory()->create();
        $star = Star::factory()->create();
        $category = Category::factory()->create();
        $opportunity = Opportunity::factory()->create();

        $inputs = [
            'title' => 'Test',
            'description' => 'Test description',
            'number_of_rooms' => 1,
            'number_of_floors' => 1,
            'address' => 'Test address',
            'city_id' => $city->id,
            'star_id' => $star->id,
            'category_id' => $category->id,
            'opportunity_id' => $opportunity->id,
        ];

        $request = $this->partialMock(StoreAccommodationRequest::class, function ($mock) use ($inputs) {
            $mock->shouldReceive('validated')->andReturn($inputs);
        });

        $response = $this->actingAs(User::all()->first())->accommodationService->store($request);

        $this->assertEquals(1, $response);
    }

    public function test_show_method_return_exception()
    {
        $this->expectException(ModelNotFoundException::class);

        $this->accommodationService->show(1);
    }
}
