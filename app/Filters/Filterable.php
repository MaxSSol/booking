<?php

namespace App\Filters;

use App\Contracts\Filter\Filter;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    public function scopeFilter(Builder $builder, Filter $filter): Builder
    {
        $filter->apply($builder);
        return $builder;
    }
}
