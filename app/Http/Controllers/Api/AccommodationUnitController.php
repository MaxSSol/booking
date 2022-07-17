<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccommodationUnitResource;
use App\Models\AccommodationUnit;
use Illuminate\Http\Request;

class AccommodationUnitController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ids) {
            return AccommodationUnitResource::collection(
                AccommodationUnit::with(['accommodationUnitImages', 'accommodation.city'])
                    ->whereIn('id', $request->ids)
                    ->get()
            );
        }
        return AccommodationUnitResource::collection(
            AccommodationUnit::with('AccommodationUnitImages')
                ->get()
        );
    }
}
