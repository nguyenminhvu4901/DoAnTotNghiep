<?php

namespace App\Http\Requests\Frontend\Order;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProcessCheckoutRequest extends FormRequest
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
            'customer_name' => ['required'],
            'customer_email' => ['required'],
            'customer_phone' => ['required'],
            'customer_address' => ['required'],
            'province' => ['required', Rule::notIn(['default'])],
            'district' => ['required', Rule::notIn(['default'])],
            'ward' => ['required', Rule::notIn(['default'])],
            'province_name' => ['required'],
            'district_name' => ['required'],
            'ward_name' => ['required'],
            'payment_method' => ['required', Rule::in([1, 2, 3])],
            'ship' => ['required'],
            'totalAllProduct' => ['required']
        ];
    }
}
