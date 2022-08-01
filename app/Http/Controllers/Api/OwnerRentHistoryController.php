<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\RentHistoryException;
use App\Http\Controllers\Controller;
use App\Http\Resources\OwnerRentHistoryResource;
use App\Models\RentHistory;
use App\Services\OwnerRentHistoryService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OwnerRentHistoryController extends Controller
{
    protected OwnerRentHistoryService $ownerRentHistoryService;

    public function __construct(OwnerRentHistoryService $ownerRentHistoryService)
    {
        $this->ownerRentHistoryService = $ownerRentHistoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return OwnerRentHistoryResource::collection($this->ownerRentHistoryService->getRentHistories());
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
     * @return OwnerRentHistoryResource
     */
    public function show($id)
    {
        return new OwnerRentHistoryResource(
            RentHistory::with(
                [
                    'accommodationUnit',
                    'user'
                ]
            )
                ->where('id', $id)
                ->get()
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return OwnerRentHistoryResource|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'check_status' => ['required', 'string', Rule::in(['confirmed', 'rejected'])]
            ]);

            $this->ownerRentHistoryService->changeRentStatus($validated, $id);

            return new OwnerRentHistoryResource(
                RentHistory::with('accommodationUnit')
                    ->where('id', $id)
                    ->get()
            );
        } catch (RentHistoryException $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }

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
