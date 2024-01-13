<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditStorageDetailFormRequest extends FormRequest
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
            'price' => ['required', 'numeric'],
            'number' => ['required', 'numeric'],
        ];
    }

    public function messages()
    {
        return [
            'quantity.required' => 'Không được bỏ trống ô này',
            'quantity.numeric' => 'Yêu cầu nhập số',
            'price.required' => 'Không được bỏ trống ô này',
            'price.numeric' => 'Yêu cầu nhập số',
            'number.required' => 'Không được bỏ trống ô này',
            'number.numeric' => 'Yêu cầu nhập số',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $data = $validator->getData();

            if ($data['quantity'] <= 0) {
                $validator->errors()->add('quantity', 'Yêu cầu nhập số lớn hơn 0 !!!');
            }
        });
    }
}
