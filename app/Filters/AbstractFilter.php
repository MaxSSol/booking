<?php

namespace App\Filters;

use App\Contracts\Filter\Filter;
use App\Http\Requests\Filters\AccommodationFilterRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class AbstractFilter implements Filter
{
    protected $queryParams = [];

    public function __construct(AccommodationFilterRequest $request)
    {
        $this->queryParams = $request->validated();
    }

    abstract protected function getCallbacks(): array;

    public function apply(Builder $builder)
    {
        foreach ($this->getCallbacks() as $param => $callback) {
            if (isset($this->queryParams[$param])) {
                call_user_func($callback, $builder, $this->queryParams[$param]);
            }
        }
    }

}
