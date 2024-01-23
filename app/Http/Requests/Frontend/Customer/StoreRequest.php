<?php

namespace App\Http\Requests\Frontend\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

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
            'email' => ['required', 'email:rfc', Rule::unique('users')],
            'name' => ['required', 'string', 'min:2'],
            'password' => ['required', PasswordRules::register($data['email'] ?? null), 'min:8', 'max:16']
        ];
    }
}
