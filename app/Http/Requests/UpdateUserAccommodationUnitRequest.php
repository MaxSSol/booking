<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserAccommodationUnitRequest extends FormRequest
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
            'title' => 'string',
            'description' => 'string',
            'number_of_rooms' => 'integer',
            'number_of_floors' => 'integer',
            'square' => 'integer',
            'max_count_people' => 'integer',
            'price' => 'integer',
            'is_available' => 'boolean',
            'date_available_from' => 'date',
            'accommodation_id' => 'integer',
            'rent_info_id' => 'integer',
            'facility_id' => 'array'
        ];
    }
}
