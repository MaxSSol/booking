<?php

namespace App\Services;

use App\Filters\AccommodationFilter;
use App\Models\Facility;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class FacilityService
{
    public function getFacilitiesWithCount(AccommodationFilter $filter): Collection
    {
        return Facility::withCount(['accommodationUnits' => function($query) use ($filter) {
            $query->whereHas('accommodation', function (Builder $query) use ($filter) {
                $query->filter($filter);
            });
        }])->get();
    }
}
