<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\AccommodationStoreException;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccommodationRequest;
use App\Http\Requests\UpdateUserAccommodationRequest;
use App\Models\Accommodation;
use App\Services\UserAccommodationService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class UserAccommodationController extends Controller
{
    protected UserAccommodationService $userAccommodationService;

    public function __construct(UserAccommodationService $userAccommodationService)
    {
        $this->middleware('auth:sanctum');
        $this->userAccommodationService = $userAccommodationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $accommodation = $this->userAccommodationService->getAccommodation();

        return response()->json(['accommodation' => $accommodation]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreAccommodationRequest $request)
    {
        try {
            $accommodationId = $this->userAccommodationService->store($request);

            return response()->json(['accommodation' => Accommodation::findOrFail($accommodationId)]);

        } catch (AccommodationStoreException $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $accommodation = $this->userAccommodationService->show($id);

            return response()->json(['accommodation' => $accommodation]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => $exception->getMessage()], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserAccommodationRequest $request, $id)
    {
        try {
            $accommodation = $this->userAccommodationService->update($request, $id);

            if ($accommodation) {
                return response()->json(['accommodation' => Accommodation::findOrFail($id)]);
            }

        } catch (AccommodationStoreException|ModelNotFoundException $exception) {
            return response()->json(['error' => $exception->getMessage()], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $accommodation = Accommodation::findOrFail($id)->delete();
        if ($accommodation) {
            return response()->json(['status' => 'true']);
        }

        return response()->json(['error' => true], 500);
    }
}
