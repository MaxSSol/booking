<?php

namespace App\Services;

use App\Exceptions\RentHistoryException;
use App\Models\Accommodation;
use App\Models\AccommodationUnit;
use App\Models\RentHistory;
use Illuminate\Support\Facades\Auth;

class OwnerRentHistoryService
{
    public function getRentHistories()
    {
        $accommodationIds = AccommodationUnit::with(
            [
                'user' => function ($query) {
                    return $query->where('id', Auth::user()->id);
                }
            ]
        )
            ->pluck('id');

        return RentHistory::with('accommodationUnit')
            ->whereIn('accommodation_unit_id', $accommodationIds->all())
            ->orderByDesc('check_status')
            ->get();
    }

    /**
     * @throws RentHistoryException
     */
    public function changeRentStatus($status, $id)
    {
        $rentHistory = RentHistory::findOrFail($id)->update($status);

        if ($rentHistory) {
            return $rentHistory;
        }

       throw new RentHistoryException('An error occurred while changing the status');
    }
}
