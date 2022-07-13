<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservationRequest;
use App\Models\RentHistory;
use App\Notifications\ReservationEmail;
use App\Services\ReservationService;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public ReservationService $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function store(StoreReservationRequest $request)
    {
//        if (!Auth::user()) {
//            return response()->json('Unauthenticated', 401);
//        }

        $accommodationUnits = $this->reservationService->getAccommodationUnit($request);
        $totalPrice = $this->reservationService->getTotalPrice($request, $accommodationUnits);

        if (count($accommodationUnits) > 1) {
            $reservation = $this->reservationService->saveAccommodationUnits($accommodationUnits, $totalPrice, $request);
            Auth::user()->notify(new ReservationEmail($accommodationUnits, $totalPrice));
            $this->reservationService->setIsAvailableFalse($request);
            $this->reservationService->sendEmailToAccommodationOwner($request);
            return response()->json(['data' => $reservation]);
        }

        $reservation = $this->reservationService->saveAccommodationUnit($accommodationUnits, $totalPrice, $request);
        if ($reservation) {
            Auth::user()->notify(new ReservationEmail($accommodationUnits, $totalPrice));
            $this->reservationService->setIsAvailableFalse($request);
            $this->reservationService->sendEmailToAccommodationOwner($request);
            return response()->json(['data' => $reservation]);
        }
        return response()->json(['status' => 'error'], 500);
    }
}
