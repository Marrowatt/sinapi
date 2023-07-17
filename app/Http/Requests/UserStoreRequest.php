<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Http\Requests\ApiRequest;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;

class UserStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'birthday' => ['required', 'string', 'date', 'before:today'],
            'phone' => ['required', 'string'],
            'weight' => ['required', 'numeric', 'gt:100'],
            'height' => ['required', 'numeric', 'gt:40'],
            'user_type' => ['required', 'string', 'exists:App\Models\UserType,name'],
            'activity_level' => ['required', 'string', 'exists:App\Models\ActivityLevel,name'],
            'gender' => ['required', 'string', 'exists:App\Models\Gender,name'],
        ];
    }
}
