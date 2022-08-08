<?php

namespace Tests\Unit\Services;

use App\Models\Accommodation;
use App\Models\AccommodationUnit;
use App\Models\City;
use App\Models\PaymentMethod;
use App\Models\RentHistory;
use App\Models\RentInfo;
use App\Models\Star;
use App\Models\User;
use App\Notifications\UpdateRentStatusEmail;
use App\Services\OwnerRentHistoryService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class OwnerRentHistoryServiceTest extends TestCase
{
    use DatabaseMigrations;

    protected OwnerRentHistoryService $rentHistoryService;
    protected $rentHistory;
    protected $accommodation;
    protected $accommodationUnit;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rentHistoryService = new OwnerRentHistoryService();
        $this->user = User::factory()->has(RentInfo::factory())->create();
        $paymentMethod = PaymentMethod::factory()->create();
        $this->accommodation = Accommodation::factory()->create([
            'user_id' => $this->user,
            'star_id' => Star::factory()->create(),
            'city_id' => City::factory()->create()
        ]);

        $this->accommodationUnit = AccommodationUnit::factory()->create([
            'rent_info_id' => $this->user->rentInfo->first()->id,
            'accommodation_id' => $this->accommodation
        ]);

        $this->rentHistory = RentHistory::factory()->create([
            'user_id' => $this->user,
            'accommodation_unit_id' => $this->accommodationUnit,
            'payment_method_id' => $paymentMethod->id
        ]);
    }

    public function test_send_status_by_email()
    {
        Notification::fake();

        $this->rentHistoryService->sendStatusEmail($this->rentHistory);

        Notification::assertSentTo($this->user, UpdateRentStatusEmail::class);
    }

    public function test_change_rent_status()
    {
        $response = $this->rentHistoryService
            ->changeRentStatus(['check_status' => 'confirmed'], $this->rentHistory->id);

        $this->assertTrue($response);
    }
}
