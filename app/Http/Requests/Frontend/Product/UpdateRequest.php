<?php

namespace App\Http\Requests\Frontend\Product;

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
            'name' => [
                'required', 'string', 'min:3',
                Rule::unique('categories', 'name')->ignore($this->slug, 'slug')
            ],
            'description' => ['required'],
            'category' => ['required']
        ];
    }
}
