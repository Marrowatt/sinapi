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
            'quantity' => ['sometimes', 'numeric','gt:0'],
            'hour' => ['sometimes', 'string', 'date_format:H:i:s'],
            'nickname' => ['sometimes', 'string', 'max:60'],
            'foods' => ['sometimes', 'array', 'min:1'],
            'foods.*.food' => ['sometimes', 'string', 'exists:App\Models\Food,name'],
            'foods.*.quantity' => ['sometimes', 'numeric', 'gt:0'],
        ];
    }
}
