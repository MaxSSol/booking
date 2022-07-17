<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserAccommodationRequest extends FormRequest
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
            'title' => 'string|max:255',
            'description' => 'string',
            'number_of_rooms' => 'integer',
            'number_of_floors' => 'integer',
            'address' => 'string',
            'city_id' => 'integer',
            'star_id' => 'integer',
            'category_id' => 'array',
            'opportunity_id' => 'array',
        ];
    }
}
