<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Http\Requests\ApiRequest;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;

class RegularUpdateRequest extends FormRequest
{
    // /**
    //  * Determine if the user is authorized to make this request.
    //  *
    //  * @return bool
    //  */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'string', 'email', 'unique:users'],
            'birthday' => ['sometimes', 'string', 'date', 'before:today'],
            'phone' => ['sometimes', 'string'],
            'weight' => ['sometimes', 'numeric', 'gt:100'],
            'height' => ['sometimes', 'numeric', 'gt:40'],
            'activity_level_id' => ['sometimes', 'numeric'],
            'gender_id' => ['sometimes', 'numeric', 'exists:genders,id'],
        ];
    }
}
