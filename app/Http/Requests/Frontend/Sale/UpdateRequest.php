<?php

namespace App\Http\Requests\Frontend\Sale;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'type' => ['required', 'numeric', 'in:0,1'],
            'value' => ['required', 'numeric'],
            'start_date' => ['required', 'date', 'before:expiry_date', 'after_or_equal:' . Carbon::today()],
            'expiry_date' => ['required', 'after:' . Carbon::today()],
            'is_active' => ['nullable']
        ];
    }
}
