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
            'customer_name' => ['required', 'string', 'min:2'],
            'customer_email' => ['required', 'email'],
            'customer_phone' => ['required', 'numeric', 'regex:/^(\+\d{1,2}\s?)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/u'],
            'customer_address' => ['required', 'string', 'min:2'],
            'note' => ['nullable', 'string'],
            'province' => ['required', Rule::notIn(['default'])],
            'district' => ['required', Rule::notIn(['default'])],
            'ward' => ['required', Rule::notIn(['default'])],
            'province_name' => ['required'],
            'district_name' => ['required'],
            'ward_name' => ['required'],
            'payment_method' => ['required', Rule::in([1, 2, 3])],
            'ship' => ['required'],
            'totalAllProduct' => ['required'],
            'subTotalAllProduct' => ['required', 'numeric'],
            'productDetail.*.productId' => ['required', 'exists:products,id'],
            'productDetail.*.name' => ['required'],
            'productDetail.*.color' => ['required'],
            'productDetail.*.size' => ['required'],
            'productDetail.*.productDetailId' => ['required', 'exists:product_detail,id'],
            'productDetail.*.quantity' => ['required'],
            'productDetail.*.price' => ['required'],
        ];
    }
}
