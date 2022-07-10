<?php

namespace App\Services;

use App\Filters\AccommodationFilter;
use App\Models\Opportunity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class OpportunityService
{
    public function getOpportunityWithCount(AccommodationFilter $filter): Collection
    {
        return Opportunity::withCount(['accommodations' => function($query) use ($filter) {
            $query->filter($filter);
        }])->get();
    }
}
