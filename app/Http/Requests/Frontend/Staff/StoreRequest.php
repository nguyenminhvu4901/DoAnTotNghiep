<?php

namespace App\Http\Requests\Frontend\Staff;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'gender' => ['required', 'numeric'],
            'email' => ['sometimes', 'email:rfc', Rule::unique('users')],
            'birthday' => ['required', 'date', 'before:today'],
            'name' => ['required'],
            'phone' => ['required', 'regex:/^(\+\d{1,2}\s?)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/u'],
            'bio' => ['nullable'],
            'password' => ['required']
        ];
    }
}
