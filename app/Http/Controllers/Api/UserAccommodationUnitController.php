<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\AccommodationUnitException;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserAccommodationUnitRequest;
use App\Http\Requests\UpdateUserAccommodationUnitRequest;
use App\Models\AccommodationUnit;
use App\Services\UserAccommodationUnitService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserAccommodationUnitController extends Controller
{
    protected UserAccommodationUnitService $userAccommodationUnitService;

    public function __construct(UserAccommodationUnitService $userAccommodationUnitService)
    {
        $this->middleware('auth:sanctum');
        $this->userAccommodationUnitService = $userAccommodationUnitService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserAccommodationUnitRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUserAccommodationUnitRequest $request)
    {
        try {
            $accommodationUnitId = $this->userAccommodationUnitService->store($request);

            return response()->json(['accommodationUnit' => AccommodationUnit::find($accommodationUnitId)]);

        } catch (AccommodationUnitException $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $accommodationUnit = $this->userAccommodationUnitService->show($id);

            return response()->json(['accommodationUnit' => $accommodationUnit]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserAccommodationUnitRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserAccommodationUnitRequest $request, $id)
    {
        try {
            $this->userAccommodationUnitService->update($request, $id);

            return response()->json(['status' => true]);

        } catch (AccommodationUnitException $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $accommodationUnit = AccommodationUnit::findOrFail($id)->delete();

        if ($accommodationUnit) {
            return response()->json(['status' => 'true']);
        }

        return response()->json(['error' => true], 500);
    }
}
