<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
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
            'first_name' => 'string|max:50',
            'last_name' => 'string|max:50',
            'password' => [Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            'password_confirmation' => 'required_id:password|same:password',
            'tel_num' => 'string|regex:/^([+]{0,1}380)\d{9}$/',
            'birth_date' => 'date',
            'sex' => [Rule::in(['male', 'female'])],
            'country' => 'string|max:70',
            'city' => 'string|max:70',
            'image' => 'image|mimes:jpeg,png,jpg|max:4096',
            'deleteImage' => 'boolean'
        ];
    }


    public function messages()
    {
        return [
            'first_name.max' => 'Максимальна довжина ім\'я 50 символів',
            'last_name.max' => 'Максимальна довжина прізвища 50 символів',
            'password' => 'Пароль має складатися мінімум з 8 символів, містить
                           літери у верхньому та нижньому регистрі, цифри та символи',
            'tel_num.regex' => 'Має починатися з +380',
            'birth_date' => 'Дата народження',
            'image.image' => 'Файл має бути фотографією',
            'image.mimes' => 'Фотографія повинна бути в одному із форматів: jpeg, png, jpg.',
            'image.max' => 'Максимальний розмір: 4 МБ',
        ];
    }
}
