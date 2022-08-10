<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Http\Requests\ApiRequest;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;

class MealUpdateRequest extends FormRequest
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
            'food' => ['sometimes', 'string', 'exists::App\Models\ActivityLevel,name'],
            'quantity' => ['sometimes', 'numeric','gt:0'],
            'hour' => ['sometimes', 'string', 'hour'],
            'nickname' => ['sometimes', 'string', 'max:60'],
        ];
    }
}
