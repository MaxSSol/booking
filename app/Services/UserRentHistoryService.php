<?php

namespace App\Services;

use App\Models\AccommodationUnit;
use App\Models\RentHistory;
use Illuminate\Support\Facades\Auth;

class UserRentHistoryService
{
    public function getAccommodation()
    {
        return RentHistory::with(
            [
                'accommodationUnit' => function ($query) {
                    $query->with('city', 'accommodationUnitImages');

                }
            ]
        )
            ->where('user_id', Auth::user()->id)
            ->get();
    }
}
