<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLoginFormRequest extends FormRequest
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
            'email' => ['required','email'],
            'password' => ['required', 'min:8']
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Không được bỏ trống ô này',
            'email.email' => 'Nhập đúng định dạng ...@gmail.com',
            'password.required' => 'Không được bỏ trống ô này',
            'password.min' => 'Không được nhập nhỏ hơn 8n ký tự'
        ];
    }
}
