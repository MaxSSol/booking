<?php

namespace App\Http\Requests\Filters;

use Illuminate\Foundation\Http\FormRequest;

class AccommodationFilterRequest extends FormRequest
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
            'city' => 'string',
            'people' => 'string',
            'rent_date_from' => 'string',
            'category_id' => 'array',
            'opportunity_id' => 'array',
            'facility_id' => 'array',
            'rooms' => 'string',
            'min_price' => 'string|nullable',
            'max_price' => 'string|nullable',
            'star_id' => 'array'
        ];
    }
}
