<?php

namespace App\Http\Controllers\Api;

use App\Filters\AccommodationFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\StarResource;
use App\Services\StarService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StarController extends Controller
{
    protected StarService $starService;

    public function __construct(StarService $starService)
    {
        $this->starService = $starService;
    }

    public function index(AccommodationFilter $filter): AnonymousResourceCollection
    {
        $stars = $this->starService->getStarsWithCount($filter);

        return StarResource::collection($stars);
    }
}
