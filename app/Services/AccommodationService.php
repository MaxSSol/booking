<?php

namespace App\Services;

use App\Filters\AccommodationFilter;
use App\Http\Requests\Filters\AccommodationFilterRequest;
use App\Models\Accommodation;

class AccommodationService
{
    /**
     * @param AccommodationFilterRequest $request
     * @param AccommodationFilter $filter
     * @return mixed
     */
    public function getAccommodationWithUnits(AccommodationFilterRequest $request, AccommodationFilter $filter)
    {
        if ($request->rent_date_from) {
            return Accommodation::with(
                [
                    'accommodationUnits' => function ($query) use ($request) {
                        $query->where('date_available_from', '<=', $request->rent_date_from)
                              ->where('max_count_people', '>=', $request->people);
                    }
                ]
            )
                ->filter($filter)->get();
        }
        return  Accommodation::filter($filter)->get();
    }
}
