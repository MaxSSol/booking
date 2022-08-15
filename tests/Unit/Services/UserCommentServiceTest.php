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
    protected $accommodation;
    protected $accommodationUnit;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->has(RentInfo::factory())->create();
        $this->commentService = new UserCommentService();
        $this->accommodation = Accommodation::factory()->create([
            'star_id' => Star::factory()->create(),
            'city_id' => City::factory()->create(),
            'user_id' => $this->user->id
        ]);

        $this->accommodationUnit = AccommodationUnit::factory()->create([
            'accommodation_id' => $this->accommodation->id,
            'rent_info_id' => $this->user->rentInfo->first()->id
        ]);
    }

    public function test_store_method_return_comment()
    {
        $inputs = [
            'accommodation_id' => $this->accommodation->id,
            'accommodation_unit_id' => $this->accommodationUnit->id,
            'comment' => 'Test',
            'location' => 8,
            'facilities' => 8,
            'service' => 8,
            'price' => 8,
        ];

        $comment = $this->actingAs(User::all()->first())->commentService->storeComment($inputs);

        $this->assertEquals($this->accommodation->id, $comment->accommodation_id);
    }

    public function test_get_comment()
    {
        $inputs = [
            'accommodation_id' => $this->accommodation->id,
            'accommodation_unit_id' => $this->accommodationUnit->id,
            'comment' => 'Test',
            'location' => 8,
            'facilities' => 8,
            'service' => 8,
            'price' => 8,
        ];

        $this->actingAs(User::all()->first())->commentService->storeComment($inputs);
        $comment = $this->actingAs(User::all()->first())->commentService->getComment($this->accommodationUnit->id);
        $this->assertEquals($comment->accommodation_unit_id, $this->accommodationUnit->id);
    }

    public function test_is_comment_exists()
    {
        $inputs = [
            'accommodation_id' => $this->accommodation->id,
            'accommodation_unit_id' => $this->accommodationUnit->id,
            'comment' => 'Test',
            'location' => 8,
            'facilities' => 8,
            'service' => 8,
            'price' => 8,
        ];

        $this->actingAs(User::all()->first())->commentService->storeComment($inputs);

        $status = $this->actingAs(User::all()->first())->commentService->isCommentExists($this->accommodationUnit->id);
        $this->assertTrue($status);

        $status = $this->actingAs(User::all()->first())->commentService->isCommentExists(18);
        $this->assertFalse($status);
    }
}
