<?php

namespace App\Http\Requests\Frontend\Cart;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
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
            'productId' => ['required', 'exists:products,id'],
            'productDetail.*.productDetailId' => ['required', 'exists:product_detail,id'],
            'productDetail.*.quantity' => ['required', 'min:0'],
        ];
    }
}
