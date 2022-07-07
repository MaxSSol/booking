<?php

namespace Database\Seeders;

use App\Models\RentHistory;
use App\Models\RentRequest;
use Illuminate\Database\Seeder;

class RentHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rentRequest = RentRequest::all()->first();

        RentHistory::factory()
            ->create(
                [
                    'total_price' => $rentRequest->total_price,
                    'rent_date_from' => $rentRequest->rent_date_from,
                    'rent_date_to' => $rentRequest->rent_date_to,
                    'user_id' => $rentRequest->user->id,
                    'payment_method_id' => $rentRequest->paymentMethod->id,
                    'accommodation_id' => $rentRequest->accommodation->id
                ]
            );
    }
}
