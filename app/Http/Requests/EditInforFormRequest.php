<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditInforFormRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'phone' => ['required', 'min:10'],
            'birthday' => ['required', 'before:13 years ago'],
            'address' => ['required'],
            'image' => ['mimes:jpeg,png,jpg,gif']
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Không được để trống ô này',
            'email.email' => 'Nhập đúng định dạng ...@gmail.com',
            'name.required' => 'Không được để trống ô này',
            'phone.required' => 'Không được để trống ô này',
            'phone.min' => 'Số điện thoại phải từ 10 số trở lên',
            'birthday.required' => 'Không được để trống ô này',
            'birthday.before' => 'Bạn phải ít nhất 13 tuổi',
            'image.mimes' => 'Yêu cầu nhập đúng định dạng: jpeg, png, jpg, gif',
            'address.required' => 'Không được để trống ô này'
        ];
    }
}
