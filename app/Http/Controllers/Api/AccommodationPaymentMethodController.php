<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AccommodationUnit;
use Illuminate\Http\Request;

class AccommodationPaymentMethodController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $accommodationUnit = AccommodationUnit::findOrFail($request->id)->accommodation->user->paymentMethods;
        return $accommodationUnit;
    }
}
