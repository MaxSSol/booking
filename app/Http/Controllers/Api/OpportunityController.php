<?php

namespace App\Http\Controllers\Api;

use App\Filters\AccommodationFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\OpportunityResource;
use App\Services\FacilityService;
use App\Services\OpportunityService;
use Illuminate\Http\Request;

class OpportunityController extends Controller
{
    /**
     * @var OpportunityService
     */
    protected OpportunityService $opportunityService;

    /**
     * @param OpportunityService $opportunityService
     */
    public function __construct(OpportunityService $opportunityService)
    {
        $this->opportunityService = $opportunityService;
    }

    /**
     * @param AccommodationFilter $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(AccommodationFilter $filter): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $opportunities = $this->opportunityService->getOpportunityWithCount($filter);

        return OpportunityResource::collection($opportunities);
    }
}
