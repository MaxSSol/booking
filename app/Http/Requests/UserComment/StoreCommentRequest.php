<?php

namespace App\Http\Requests\UserComment;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
            'accommodation_id' => 'required|integer',
            'accommodation_unit_id' => 'required|integer',
            'comment' => 'string|nullable',
            'location' => 'required|integer',
            'facilities' => 'required|integer',
            'service' => 'required|integer',
            'price' => 'required|integer',
        ];
    }
}
