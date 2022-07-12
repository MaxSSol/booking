<?php

namespace App\Http\Controllers\Api;

use App\Filters\AccommodationFilter;
use App\Filters\AccommodationUnitFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Filters\AccommodationFilterRequest;
use App\Http\Resources\AccommodationResource;
use App\Models\Accommodation;
use App\Services\AccommodationService;
use Illuminate\Http\Request;

class AccommodationController extends Controller
{
    public AccommodationService $accommodationService;

    /**
     * @param AccommodationService $accommodationService
     */
    public function __construct(AccommodationService $accommodationService)
    {
        $this->accommodationService = $accommodationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(AccommodationUnitFilter $accommodationUnitFilter, AccommodationFilter $accommodationFilter)
    {
        $accommodation = $this->accommodationService
            ->getAccommodationWithUnits($accommodationUnitFilter, $accommodationFilter);

        $maxPrice = $this->accommodationService->getMaxPrice($accommodation->get());
        $minPrice = $this->accommodationService->getMinPrice($accommodation->get());

        return AccommodationResource::collection($accommodation->paginate(10))
            ->additional(['min_price' => $minPrice, 'max_price' => $maxPrice]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function show($id, AccommodationUnitFilter $filter)
    {
        $accommodation = $this->accommodationService->getAccommodationByIdWithUnits($id, $filter);
        $totalRating = $this->accommodationService->getAccommodationTotalRatingById($id);
        $countComments = $this->accommodationService->getAccommodationCountCommentsById($id);
        return AccommodationResource::collection($accommodation)
            ->additional(['total_rating' => $totalRating, 'count_comments' => $countComments]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
