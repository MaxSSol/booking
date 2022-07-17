<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
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
            'rent_date_from' => 'required|string',
            'rent_date_to' => 'required|string',
            'comment' => 'string|max:1024|nullable',
            'number_of_people' => 'required',
            'accommodation_unit_id' => 'required|array',
            'payment_method_id' => 'required'
        ];
    }
}
