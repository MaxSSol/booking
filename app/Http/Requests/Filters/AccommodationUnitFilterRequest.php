<?php

namespace App\Http\Requests\Filters;

use Illuminate\Foundation\Http\FormRequest;

class AccommodationUnitFilterRequest extends FormRequest
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
            'facility_id' => 'array',
            'min_price' => 'string',
            'max_price' => 'string'
        ];
    }
}
