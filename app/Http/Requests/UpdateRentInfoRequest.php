<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRentInfoRequest extends FormRequest
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
            'rent_for_short_term' => 'integer',
            'rent_for_long_term' => 'integer',
            'free_termination' => 'boolean',
            'leave_termination_price' => 'integer'
        ];
    }
}
