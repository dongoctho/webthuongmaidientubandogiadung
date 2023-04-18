<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRegisterFormRequest extends FormRequest
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
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'phone' => ['required', 'min:10', 'max:12', 'numeric'],
            'password' => ['required', 'min:8'],
            'repassword' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Không được bỏ trống ô này',
            'email.unique' => 'Email đã tồn tại',
            'email.email' => 'Nhập đúng định dạng ...@gmail.com',
            'password.required' => 'Không được bỏ trống ô này',
            'password.min' => 'Mật khẩu không được nhỏ hơn 8 ký tự',
            'name.required' => 'Không được bỏ trống ô này',
            'repassword.required' => 'Không được bỏ trống ô này',
            'phone.required' => 'Không được bỏ trống ô này',
            'phone.min' => 'Số điện thoại không được nhỏ hon 10 ký tự',
            'phone.max' => 'Số điện thoại không được lớn hơn 12 ký tự'
        ];
    }
}
