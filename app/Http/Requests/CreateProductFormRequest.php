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
            'code' => ['required', 'min:4', 'unique:products'],
            'name' => ['required', 'unique:products'],
            'price' => ['required', 'numeric'],
            'description' => ['required']
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
            'description.required' => 'Không được bỏ trống ô này'
        ];
    }
}
