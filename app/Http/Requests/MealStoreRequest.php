<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Http\Requests\ApiRequest;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;

class MealStoreRequest extends FormRequest
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
            'user' => ['required', 'numeric', 'exists:App\Models\User,id'],
            'hour' => ['required', 'string', 'date_format:H:i'],
            'nickname' => ['sometimes', 'string', 'max:60'],
            'foods' => ['required', 'array', 'min:1'],
            'foods.*.food' => ['required', 'string', 'exists:App\Models\Food,name'],
            'foods.*.quantity' => ['required', 'numeric', 'gt:0'],
        ];
    }
}
