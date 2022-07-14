<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserRentHistoryResource;
use App\Services\UserRentHistoryService;

class UserRentHistoryController extends Controller
{
    protected UserRentHistoryService $userRentHistoryService;

    public function __construct(UserRentHistoryService $userRentHistoryService)
    {
        $this->middleware('auth:sanctum');
        $this->userRentHistoryService = $userRentHistoryService;
    }

    public function index()
    {
        return  UserRentHistoryResource::collection($this->userRentHistoryService->getAccommodation());
    }
}
