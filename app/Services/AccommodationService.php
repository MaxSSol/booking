<?php

namespace App\Services;

use App\Filters\AccommodationFilter;
use App\Filters\AccommodationUnitFilter;
use App\Http\Requests\Filters\AccommodationFilterRequest;
use App\Models\Accommodation;
use Illuminate\Database\Eloquent\Builder;


class AccommodationService
{
    /**
     * @param AccommodationUnitFilter $accommodationUnitFilter
     * @param AccommodationFilter $accommodationFilter
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
                    $query
                        ->where('is_available', true)
                        ->filter($accommodationUnitFilter)
                        ->with(['accommodationUnitImages']);
                },
                'accommodationImages'
            ]
        )->filter($accommodationFilter)->get();
    }
}
