<?php

namespace App\Services;

use App\Filters\AccommodationFilter;
use App\Filters\AccommodationUnitFilter;
use App\Http\Requests\Filters\AccommodationFilterRequest;
use App\Models\Accommodation;

class AccommodationService
{
    /**
     * @param AccommodationFilterRequest $request
     * @param AccommodationFilter $filter
     * @return mixed
     */
    public function getAccommodationWithUnits(
        AccommodationUnitFilter $accommodationUnitFilter,
        AccommodationFilter     $accommodationFilter
    )
    {
        return Accommodation::with(
            [
                'accommodationUnits' => function ($query) use ($accommodationUnitFilter) {
                    $query->filter($accommodationUnitFilter)->with(['accommodationUnitImages']);
                },
                'accommodationImages'
            ]
        )
            ->filter($accommodationFilter)->get();
    }
}
