<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\AccommodationCommentException;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserComment\StoreCommentRequest;
use App\Http\Resources\UserCommentResource;
use App\Models\AccommodationComment;
use App\Services\UserCommentService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserCommentController extends Controller
{
    protected UserCommentService $userCommentService;

    public function __construct(UserCommentService $userCommentService)
    {
        $this->userCommentService = $userCommentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return UserCommentResource::collection($this->userCommentService->getComments());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCommentRequest $request
     * @return UserCommentResource|\Illuminate\Http\JsonResponse
     */
    public function store(StoreCommentRequest $request)
    {
        try {
            return new UserCommentResource($this->userCommentService->storeComment($request->validated()));
        } catch (AccommodationCommentException $exception) {
            return \response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
