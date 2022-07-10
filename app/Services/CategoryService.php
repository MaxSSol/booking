<?php

namespace App\Services;

use App\Filters\AccommodationFilter;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    /**
     * @param AccommodationFilter $filter
     * @return Collection
     */
    public function getCategoriesWithCount(AccommodationFilter $filter): Collection
    {
        return Category::withCount(['accommodations' => function($query) use ($filter) {
            $query->filter($filter);
        }])->get();
    }
}
