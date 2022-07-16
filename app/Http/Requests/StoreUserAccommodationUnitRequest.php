<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserAccommodationUnitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'number_of_rooms' => 'required|integer',
            'number_of_floors' => 'required|integer',
            'square' => 'required',
            'max_count_people' => 'required|integer',
            'price' => 'required|integer',
            'is_available' => 'required|boolean',
            'date_available_from' => 'required|date',
            'accommodation_id' => 'required|integer',
            'rent_info_id' => 'required|integer',
            'facility_id' => 'required|array'
        ];
    }
}
