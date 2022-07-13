<?php

namespace App\Services;

use App\Filters\AccommodationFilter;
use App\Filters\AccommodationUnitFilter;
use App\Models\Accommodation;
use App\Models\AccommodationComment;
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
            ->filter($accommodationFilter);
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

    public function getAccommodationByIdWithUnits($id, AccommodationUnitFilter $filter)
    {
        return Accommodation::with(
            [
                'accommodationUnits' => function ($query) use ($filter) {
                    $query->filter($filter)
                        ->where('is_available', true)
                        ->with('facilities:id,title', 'accommodationUnitImages');
                },
                'city',
                'opportunities:id,title',
                'accommodationImages',
                'categories'
            ]
        )->where('id', $id)->get();
    }

    public function getAccommodationTotalRatingById($id)
    {
        $totalRating = AccommodationComment::where('accommodation_id', $id)->avg('total_rating');
        $facilities = AccommodationComment::where('accommodation_id', $id)->avg('facilities');
        $location = AccommodationComment::where('accommodation_id', $id)->avg('location');
        $service = AccommodationComment::where('accommodation_id', $id)->avg('service');
        $price = AccommodationComment::where('accommodation_id', $id)->avg('price');

        return [
            'total_rating' => $totalRating,
            'facilities' => $facilities,
            'location' => $location,
            'service' => $service,
            'price' => $price
        ];
    }

    public function getAccommodationCountCommentsById($id)
    {
        return AccommodationComment::where('accommodation_id', $id)->count();
    }
}
