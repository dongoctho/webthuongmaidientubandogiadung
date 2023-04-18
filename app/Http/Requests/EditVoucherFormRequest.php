<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditVoucherFormRequest extends FormRequest
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
            'code' => ['required', 'min:4'],
            'name' => ['required'],
            'discount' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Không được để trống ô này',
            'name.required' => 'Không được để trống ô này',
            'code.min' => 'Không được nhập nhỏ hơn 4 ký tự',
            'discount.required' => 'Không được để trống ô này',
            'discount.numeric' => 'Yêu cầu nhập số',
            'quantity.required' => 'Không được để trống ô này',
            'quantity.numeric' => 'Yêu cầu nhập số'
        ];
    }
}
