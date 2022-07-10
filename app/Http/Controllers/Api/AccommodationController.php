<?php

namespace App\Http\Controllers\Api;

use App\Filters\AccommodationFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Filters\AccommodationFilterRequest;
use App\Http\Resources\AccommodationResource;
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
    public function index(AccommodationFilterRequest $request, AccommodationFilter $filter)
    {
        $accommodation = $this->accommodationService->getAccommodationWithUnits($request, $filter);

        return AccommodationResource::collection($accommodation);
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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
