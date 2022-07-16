<?php

namespace App\Services;

use App\Exceptions\AccommodationStoreException;
use App\Models\Accommodation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class UserAccommodationService
{
    public function getAccommodation()
    {
        return Accommodation::where('user_id', Auth::user()->id)
            ->with(
                'accommodationImages',
                'city',
                'categories',
                'opportunities',
                'star'
            )
            ->get();

    }

    public function store($request)
    {
        $validated = collect($request->validated());
        $validated->put('user_id', Auth::user()->id);

        $accommodation = Accommodation::create($validated->all());
        $accommodationId = $accommodation->id;

        $accommodation->categories()->syncWithoutDetaching($validated->get('category_id'));
        $accommodation->opportunities()->syncWithoutDetaching($validated->get('opportunity_id'));

        if ($accommodationId) {
            return $accommodationId;
        }

        throw new AccommodationStoreException('Accommodation store problem');
    }

    public function show($id)
    {
        $accommodation = Accommodation::with(
            'accommodationImages',
            'city',
            'categories',
            'opportunities',
            'star'
        )
            ->find($id);

        if ($accommodation) {
            return $accommodation;
        }

        throw new ModelNotFoundException('Accommodation not found by id ' . $id);
    }

    /**
     * @throws AccommodationStoreException
     */
    public function update($request, $id)
    {
        $accommodation = Accommodation::findOrFail($id);

        $update = $accommodation->update($request->validated());

        $accommodation->categories()->sync($request->category_id);
        $accommodation->opportunities()->sync($request->opportunity_id);


        if ($update) {
            return true;
        }

        throw new AccommodationStoreException('Accommodation update problem');
    }
}
