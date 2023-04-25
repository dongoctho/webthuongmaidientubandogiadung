<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductFormRequest extends FormRequest
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
            'code' => ['required', 'min:4', 'unique:products,code,'.$this->id, 'regex:/(PD)[0-9]{2}/'],
            'name' => ['required'],
            'price' => ['required', 'numeric'],
            'description' => ['required'],
            'image' => ['mimes:jpeg,png,jpg,gif'],
            'discount' => ['required', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Không được để trống ô này',
            'name.required' => 'Không được để trống ô này',
            'code.min' => 'Không được nhập nhỏ hơn 4 ký tự',
            'price.required' => 'Không được để trống ô này',
            'price.numeric' => 'Yêu cầu nhập số',
            'discount.required' => 'Không được để trống ô này',
            'discount.numeric' => 'Yêu cầu nhập số',
            'description.required' => 'Không được để trống ô này',
            'image.mimes' => 'Yêu cầu nhập đúng định dạng: jpeg, png, jpg, gif',
            'code.unique' => 'Mã bị trùng',
            'code.regex' => 'Nhập đúng định dạng PD + số'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $data = $validator->getData();

            if ($data['price'] <= 0) {
                $validator->errors()->add('price', 'Yêu cầu nhập số lớn hơn 0 !!!');
            }
            if ($data['product_type'] == 0) {
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
