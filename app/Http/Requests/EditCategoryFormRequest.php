<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCategoryFormRequest extends FormRequest
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
            'code' => ['required', 'min:4', 'unique:categories,code,'.$this->id, 'regex:/(CG)[0-9]{2}/'],
            'name' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Không được bỏ trống ô này',
            'name.required' => 'Không được bỏ trống ô này',
            'code.min' => 'Không được nhập nhỏ hơn 4 ký tự',
            'code.unique' => 'Mã bị trùng',
            'code.regex' => 'Nhập đúng định dạng CG + số'
        ];
    }
}
