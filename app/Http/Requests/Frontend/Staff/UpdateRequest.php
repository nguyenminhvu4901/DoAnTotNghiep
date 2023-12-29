<?php

namespace App\Http\Requests\Frontend\Staff;

use App\Domains\Staff\Services\StaffService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    protected StaffService $staffService;

    public function __construct(StaffService $staffService)
    {
        $this->staffService = $staffService;
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
        $targetUser = $this->staffService->getById($this->id)->user;
        return [
            'gender' => ['required', 'numeric'],
            'email' => [
                'sometimes',
                'email:rfc',
                Rule::unique('users', 'email')->ignore($targetUser->id)
            ],
            'birthday' => ['required', 'date', 'before:today'],
            'name' => ['required'],
            'password' => ['nullable'],
            'phone' => ['required', 'regex:/^(\+\d{1,2}\s?)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/u']
        ];
    }
}
