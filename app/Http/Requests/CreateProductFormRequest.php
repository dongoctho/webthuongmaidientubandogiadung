<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductFormRequest extends FormRequest
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
            'code' => ['required', 'min:4', 'unique:products,deleted_at,NULL', 'regex:/(PD)[0-9]{2}/'],
            'name' => ['required', 'unique:products'],
            'price' => ['required', 'numeric'],
            'description' => ['required'],
            'image' => ['required', 'mimes:jpeg,png,jpg,gif']
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Không được bỏ trống ô này',
            'code.unique' => 'Mã bị trùng',
            'name.required' => 'Không được bỏ trống ô này',
            'code.min' => 'Không được nhập nhỏ hơn 4 ký tự',
            'price.required' => 'Không được bỏ trống ô này',
            'price.numeric' => 'Yêu cầu nhập số',
            'description.required' => 'Không được bỏ trống ô này',
            'image.required' => 'Không được bỏ trống ô này',
            'image.mimes' => 'Yêu cầu nhập đúng định dạng: jpeg, png, jpg, gif',
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
        });
    }
}
