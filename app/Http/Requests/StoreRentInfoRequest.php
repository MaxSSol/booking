<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRentInfoRequest extends FormRequest
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
            'rent_for_short_term' => 'required|integer',
            'rent_for_long_term' => 'required|integer',
            'free_termination' => 'required|boolean',
            'leave_termination_price' => 'required|integer'
        ];
    }
}
