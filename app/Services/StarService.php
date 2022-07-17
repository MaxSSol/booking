<?php

namespace App\Services;

use App\Filters\AccommodationFilter;
use App\Models\Star;
use Illuminate\Database\Eloquent\Collection;

class StarService
{
    public function getStarsWithCount(AccommodationFilter $filter): Collection
    {
        return Star::withCount(['accommodations' => function($query) use ($filter) {
            $query->filter($filter);
        }])->get();
    }
}
