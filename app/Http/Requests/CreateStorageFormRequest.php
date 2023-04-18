<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateStorageFormRequest extends FormRequest
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
            'quantity' => ['required', 'numeric'],
            'description' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'quantity.required' => 'Không được bỏ trống ô này',
            'quantity.numeric' => 'Yêu cầu nhập số',
            'description.required' => 'Không được bỏ trống ô này',
        ];
    }
}
