<?php

namespace App\Http\Controllers\Api;

use App\Filters\AccommodationFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\FacilityResource;
use App\Services\FacilityService;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    protected FacilityService $facilityService;

    public function __construct(FacilityService $facilityService)
    {
        $this->facilityService = $facilityService;
    }

    public function index(AccommodationFilter $filter)
    {
        $facilities = $this->facilityService->getFacilitiesWithCount($filter);

        return FacilityResource::collection($facilities);
    }
}
