<?php

namespace Tests\Unit\Services;

use App\Models\Accommodation;
use App\Models\City;
use App\Models\Star;
use App\Models\User;
use App\Services\AccommodationImageService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class AccommodationImageServiceTest extends TestCase
{
    use DatabaseMigrations;

    protected AccommodationImageService $service;
    protected $accommodation;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new AccommodationImageService();
        $this->accommodation = Accommodation::factory()
            ->create([
                'user_id' => User::factory()->create(),
                'star_id' => Star::factory()->create(),
                'city_id' => City::factory()->create()
            ]);
    }

    public function test_upload_images()
    {
        $storeStatus = $this->service->upload(
            [
                UploadedFile::fake()->image('image1.jpeg'),
                UploadedFile::fake()->image('image2.jpeg')
            ],
            $this->accommodation->id
        );

        $this->assertTrue($storeStatus);
    }
}
