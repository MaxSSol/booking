<?php

namespace Tests\Unit\Services;


use App\Models\Accommodation;
use App\Models\AccommodationUnit;
use App\Models\City;
use App\Models\RentInfo;
use App\Models\Star;
use App\Models\User;
use App\Services\UserCommentService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserCommentServiceTest extends TestCase
{
    use DatabaseMigrations;

    protected UserCommentService $commentService;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->has(RentInfo::factory())->create();
        $this->commentService = new UserCommentService();
    }

    public function test_store_method_return_comment()
    {

        $accommodation = Accommodation::factory()->create([
           'star_id' => Star::factory()->create(),
           'city_id' => City::factory()->create(),
           'user_id' => $this->user->id
        ]);

        $accommodationUnit = AccommodationUnit::factory()->create([
            'accommodation_id' => $accommodation->id,
            'rent_info_id' => $this->user->rentInfo->first()->id
        ]);

        $inputs = [
            'accommodation_id' => $accommodation->id,
            'accommodation_unit_id' => $accommodationUnit->id,
            'comment' => 'Test',
            'location' => 8,
            'facilities' => 8,
            'service' => 8,
            'price' => 8,
        ];

        $comment = $this->actingAs(User::all()->first())->commentService->storeComment($inputs);

        $this->assertEquals($accommodation->id, $comment->accommodation_id);
    }
}
