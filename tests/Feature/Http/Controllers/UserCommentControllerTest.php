<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Accommodation;
use App\Models\AccommodationComment;
use App\Models\AccommodationUnit;
use App\Models\City;
use App\Models\RentInfo;
use App\Models\Star;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserCommentControllerTest extends TestCase
{
    use DatabaseMigrations;

    protected $user;
    protected $accommodation;
    protected $accommodationUnit;
    protected $accommodationComment;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->has(RentInfo::factory())->create();

        $this->accommodation = Accommodation::factory()->create([
            'star_id' => Star::factory()->create(),
            'city_id' => City::factory()->create(),
            'user_id' => $this->user->id
        ]);

        $this->accommodationUnit = AccommodationUnit::factory()->create([
            'accommodation_id' => $this->accommodation->id,
            'rent_info_id' => $this->user->rentInfo->first()->id
        ]);

        $this->accommodationComment = AccommodationComment::factory()->create(
            [
                'accommodation_id' => $this->accommodation->id,
                'accommodation_unit_id' => $this->accommodationUnit->id,
                'user_id' => $this->user->id
            ]
        );
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_method_return_comment()
    {
        $response = $this->actingAs(User::all()->first())->get('/api/user/comments');

        $response->assertStatus(200);
        $response->assertJsonPath('data.0.accommodation_id', $this->accommodation->id);
    }

    public function test_index_method_return_unauth()
    {
        $response = $this->get('/api/user/comments');

        $response->assertSeeText('Unauthenticated.');
    }

    public function test_store_method_return_unauth()
    {
        $response = $this->post('/api/user/comments');

        $response->assertSeeText('Unauthenticated.');
    }

    public function test_store_method_with_wrong_data()
    {
        $response = $this->actingAs(User::all()->first())->post('/api/user/comments');

        $response->assertStatus(302);
    }

    public function test_store_method_with_true_data()
    {
        $response = $this->actingAs(User::all()->first())->post('/api/user/comments', [
            'accommodation_id' => $this->accommodation->id,
            'accommodation_unit_id' => $this->accommodationUnit->id,
            'comment' => 'Test',
            'location' => 9,
            'facilities' => 10,
            'service' => 8,
            'price' => 9,
        ]);

        $response->assertStatus(200);
        $response->assertJsonPath('data.accommodation_id', $this->accommodation->id);
    }

    public function test_show_method_with_true_data()
    {
        $response = $this->actingAs(User::all()->first())->get('/api/user/comments/' . $this->accommodationUnit->id);

        $response->assertStatus(200);
        $response->assertJsonPath('data.accommodation_unit_id', $this->accommodationUnit->id);
    }

    public function test_show_method_with_wrong_data()
    {
        $response = $this->actingAs(User::all()->first())->get('/api/user/comments/18');

        $response->assertJsonPath('data', []);
    }
}
