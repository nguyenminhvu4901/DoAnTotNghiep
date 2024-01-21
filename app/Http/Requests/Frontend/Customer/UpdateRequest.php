<?php

namespace App\Http\Requests\Frontend\Customer;

use App\Domains\Auth\Services\UserService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

class UpdateRequest extends FormRequest
{

    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

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
            'email' => [
                'sometimes',
                'email:rfc',
                Rule::unique('users', 'email')->ignore($this->id)
            ],
            'name' => ['required', 'string', 'min:2'],
            'password' => ['required', PasswordRules::register($data['email'] ?? null), 'min:8', 'max:16']
        ];
    }
}
