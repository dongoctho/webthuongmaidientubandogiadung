<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateVoucherFormRequest extends FormRequest
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
            'code' => ['required', 'min:4', 'unique:vouchers'],
            'name' => ['required', 'unique:vouchers'],
            'discount' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Không được bỏ trống ô này',
            'name.required' => 'Không được bỏ trống ô này',
            'code.min' => 'Không được nhập nhỏ hơn 4 ký tự',
            'discount.required' => 'Không được bỏ trống ô này',
            'discount.numeric' => 'Yêu cầu nhập số',
            'quantity.required' => 'Không được bỏ trống ô này',
            'quantity.numeric' => 'Yêu cầu nhập số'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $data = $validator->getData();
            if ($data['voucher_type'] == 0) {
                if ($data['discount'] > 100 || $data['discount'] < 0) {
                    $validator->errors()->add('discount', 'Yêu cầu nhập số từ 1 - 100 !!!');
                }
            } else {
                if ($data['discount'] < 0) {
                    $validator->errors()->add('discount', 'Yêu cầu nhập số lớn hơn 0 !!!');
                }
            }
        });
    }
}
