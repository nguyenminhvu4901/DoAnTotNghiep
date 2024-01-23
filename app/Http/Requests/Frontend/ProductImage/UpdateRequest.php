<?php

namespace App\Http\Requests\Frontend\ProductImage;

use Illuminate\Validation\Rule;
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
            'name' => ['required', 'string', Rule::unique('product_image', 'name')->ignore($this->productImageId, 'id')],
            'image_path' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:10000'],
            'order' => [
                'required', 'integer', Rule::unique('product_image')->where(function ($query) {
                    return $query->where('product_id', $this->productId);
                })->ignore($this->productImageId, 'id'),
            ],
        ];
    }
}
