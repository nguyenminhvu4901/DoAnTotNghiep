<?php

namespace App\Http\Requests\Frontend\Order;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'subAllProduct' => ['required', 'numeric'],
            'totalAllProduct' => ['required', 'numeric'],
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
