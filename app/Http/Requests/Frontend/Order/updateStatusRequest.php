<?php

namespace App\Http\Requests\Frontend\Order;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class updateStatusRequest extends FormRequest
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
            'status' => [Rule::in([1, 2, 3, 4, 5])],
        ];
    }
}
