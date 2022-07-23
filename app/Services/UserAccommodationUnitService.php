<?php

namespace App\Services;

use App\Exceptions\AccommodationUnitException;
use App\Models\AccommodationUnit;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserAccommodationUnitService
{
    /**
     * @throws AccommodationUnitException
     */
    public function store($request)
    {
        $accommodationUnit = AccommodationUnit::create($request->validated());
        $accommodationUnitId = $accommodationUnit->id;

        $accommodationUnit->facilities()->syncWithoutDetaching($request->facility_id);

        if ($accommodationUnitId) {
            return $accommodationUnitId;
        }

        throw new AccommodationUnitException('Accommodation store problem');
    }

    /**
     * @throws AccommodationUnitException
     */
    public function update($request, $id): bool
    {
        $accommodationUnit = AccommodationUnit::findOrFail($id);

        $update = $accommodationUnit->update($request->validated());

        $accommodationUnit->facilities()->sync($request->facilities);

        if ($update) {
            return true;
        }

        throw new AccommodationUnitException('Accommodation unit update problem');
    }

    public function show($id)
    {
        $accommodationUnit = AccommodationUnit::with(
            'accommodationUnitImages',
            'facilities',
            'rentInfo'
        )
            ->find($id);

        if ($accommodationUnit) {
            return $accommodationUnit;
        }

        throw new ModelNotFoundException('Accommodation unit not found by id ' . $id);
    }
}
