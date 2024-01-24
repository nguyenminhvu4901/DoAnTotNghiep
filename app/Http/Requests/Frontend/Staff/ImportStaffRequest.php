<?php

namespace App\Http\Requests\Frontend\Staff;

use Illuminate\Foundation\Http\FormRequest;

class ImportStaffRequest extends FormRequest
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
            'file-staff' => ['required', 'mimes:xlsx,xls']
        ];
    }

    public function attributes()
    {
        return [
            'file-staff' => __('file staff'),
        ];
    }
}
