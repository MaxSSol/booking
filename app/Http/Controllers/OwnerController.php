<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        if (!Auth::user()) {
            return response()->json([], 401);
        }

        $accommodationExist = Accommodation::where('user_id', Auth::user()->id)->get();

        if ($accommodationExist->first()) {
            return response()->json(['status' => true]);
        }

        return response()->json(['status' => false], 404);
    }
}
