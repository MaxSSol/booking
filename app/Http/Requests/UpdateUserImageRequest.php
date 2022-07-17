<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserImageRequest extends FormRequest
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
            'image' => 'image|mimes:mimes:jpeg,png,jpg|max:4096'
        ];
    }

    public function messages()
    {
        parent::messages();

        return [
            'image.image' => 'Файл має бути зображенням.',
            'image.mimes' => 'Зображення повинне бути в одному із форматів: jpeg, png, jpg.',
            'image.max' => 'Максимальний розмір зображення: 4 МБ.',
        ];
    }
}
