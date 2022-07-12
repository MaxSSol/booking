<?php

namespace App\Services;

use App\Filters\AccommodationFilter;
use App\Filters\AccommodationUnitFilter;
use App\Models\Accommodation;
use Illuminate\Database\Eloquent\Collection;


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
                        ->with(['accommodationUnitImages', 'facilities'])
                        ->orderBy('price');
                },
                'accommodationImages',
                'city',
                'star'
            ]
        )
            ->filter($accommodationFilter)
            ;
    }

    public function getMaxPrice(Collection $accommodation)
    {
        $maxPrice = $accommodation->map(function ($accommodationItem) {
            return $accommodationItem->accommodationUnits->max('price');
        });

        return $maxPrice->max();
    }

    public function getMinPrice(Collection $accommodation)
    {
        $minPrice = $accommodation->map(function ($accommodationItem) {
            return $accommodationItem->accommodationUnits->min('price');
        });

        return $minPrice->min();
    }
}
