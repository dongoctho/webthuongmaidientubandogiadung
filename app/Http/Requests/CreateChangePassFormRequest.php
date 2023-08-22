<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateChangePassFormRequest extends FormRequest
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
            'password' => ['required', 'min:8'],
            'repassword' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Không được bỏ trống ô này',
            'password.min' => 'Không được nhập nhỏ hơn 8 ký tự',
            'repassword.required' => 'Không được bỏ trống ô này',
        ];
    }
}
