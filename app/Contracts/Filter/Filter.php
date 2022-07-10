<?php

namespace App\Contracts\Filter;

use Illuminate\Database\Eloquent\Builder;

interface Filter
{
    public function apply(Builder $builder);
}
