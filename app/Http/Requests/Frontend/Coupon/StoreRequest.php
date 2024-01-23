<?php

namespace App\Http\Requests\Frontend\Coupon;

use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

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
            'name' => ['required', 'unique:coupons,name', 'string'],
            'type' => ['required', 'numeric', 'in:0,1'],
            'value' => ['required', 'numeric'],
            'start_date' => ['required', 'date', 'before:expiry_date'],
            'expiry_date' => ['required', 'after:' . Carbon::today()],
            'quantity' => ['required', 'integer'],
            'description' => ['string']
        ];
    }
}
