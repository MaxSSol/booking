<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccommodationRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'number_of_rooms' => 'required|integer',
            'number_of_floors' => 'required|integer',
            'address' => 'required|string',
            'city_id' => 'required|integer',
            'star_id' => 'required|integer',
            'category_id' => 'required|array',
            'opportunity_id' => 'required|array',

        ];
    }
}
