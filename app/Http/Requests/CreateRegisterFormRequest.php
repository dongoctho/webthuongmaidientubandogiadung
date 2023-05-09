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
            'email' => ['required', 'regex:/(.*)@gmail\.com/i', 'unique:users'],
            'phone' => ['required', 'min:10', 'numeric', 'regex:/(0)[0-9]{9}/'],
            'password' => ['required', 'min:8'],
            'repassword' => ['required'],
            'birthday' => ['required','before:13 years ago'],
        ];

    }

    public function messages()
    {
        return [
            'birthday.required' => 'Không được bỏ trống ô này',
            'email.required' => 'Không được bỏ trống ô này',
            'email.unique' => 'Email đã tồn tại',
            'email.regex' => 'Nhập đúng định dạng ...@gmail.com',
            'password.required' => 'Không được bỏ trống ô này',
            'password.min' => 'Mật khẩu không được nhỏ hơn 8 ký tự',
            'name.required' => 'Không được bỏ trống ô này',
            'repassword.required' => 'Không được bỏ trống ô này',
            'phone.required' => 'Không được bỏ trống ô này',
            'phone.min' => 'Số điện thoại không được nhỏ hon 10 ký tự',
            'phone.regex' => 'Nhập đúng định dạng số điện thoại',
            'phone.numeric' => 'Nhập đúng định dạng số điện thoại',
            'birthday.before' => 'Bạn phải ít nhất 13 tuổi',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $data = $validator->getData();

            if ($data['phone'] <= 0) {
                $validator->errors()->add('phone', 'Yêu cầu nhập số lớn hơn 0 !!!');
            }
            if ($data['password'] !== $data['repassword']) {
                $validator->errors()->add('repassword', 'Nhập lại mật khẩu không đúng !!!');
            }
        });
    }
}
