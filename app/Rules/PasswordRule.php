<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class PasswordRule implements Rule
{
    protected string $errorMsg;

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $genericRules = [
            $attribute => ['min:8', 'max:16']
        ];

        $validator = Validator::make([$attribute => $value], $genericRules);

        if ($validator->fails()) {
            $this->errorMsg = $validator->errors()->first($attribute);
            return false;
        }

        switch ($value) {
            case (!preg_match('/[a-z]/', $value)):
                $this->errorMsg = ':attribute must contain at least one lowercase character';
                return false;
            case(!preg_match('/[A-Z]/', $value)):
                $this->errorMsg = ':attribute must contain at least one uppercase character';
                return false;
            case(!preg_match('/[0-9]/', $value)):
                $this->errorMsg = ':attribute must contain at least one numeric character';
                return false;
            case(!preg_match('/[^a-zA-Z0-9]/', $value)):
                $this->errorMsg = ':attribute must contain at least one special character';
                return false;
            default:
                return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return __($this->errorMsg);
    }
}
