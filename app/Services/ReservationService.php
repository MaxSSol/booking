<?php

namespace App\Services;

use App\Models\AccommodationUnit;
use App\Models\RentHistory;
use App\Notifications\RequestReservationEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class ReservationService
{
    public function getTotalPrice($request, Collection $accommodationUnit)
    {
        $rentDateFrom = Carbon::parse($request->rent_date_from);
        $rentDateTo = Carbon::parse($request->rent_date_to);
        $days = $rentDateTo->diffInDays($rentDateFrom);
        $sum = $accommodationUnit->sum('price');
        return $sum * $days;
    }

    public function getAccommodationUnit($request)
    {
        $units = $request->accommodation_unit_id;
        if (count($units) > 1) {
            return AccommodationUnit::all()->whereIn('id', $units);
        }
        return AccommodationUnit::findOrFail($units);
    }

    public function saveAccommodationUnits($accommodationUnits, $totalPrice, $request)
    {
        foreach ($accommodationUnits as $accommodationUnit) {
            return $this->extracted($request, $totalPrice, $accommodationUnit);
        }
    }

    public function saveAccommodationUnit($accommodationUnits, $totalPrice, $request)
    {
        return $this->extracted($request, $totalPrice, $accommodationUnits);

    }

    /**
     * @param $request
     * @param $totalPrice
     * @param $accommodationUnits
     * @return mixed
     */
    public function extracted($request, $totalPrice, $accommodationUnits)
    {
        $validated = $request->validated();
        $validated['total_price'] = $totalPrice;
        $validated['user_id'] = Auth::user()->id;
        $validated['accommodation_unit_id'] = $accommodationUnits->first()->id;
        $validated['price'] = $accommodationUnits->first()->price;
        return RentHistory::create($validated);
    }

    public function sendEmailToAccommodationOwner($request)
    {
        $accommodationUnit = AccommodationUnit::whereIn('id', $request->accommodation_unit_id)->first();
        $accommodationUnit->user->notify(new RequestReservationEmail());
    }

    public function setIsAvailableFalse($request)
    {
        foreach ($request->accommodation_unit_id as $id) {
            AccommodationUnit::where('id', $id)->update([ 'is_available' => false]);
        }
    }
}
