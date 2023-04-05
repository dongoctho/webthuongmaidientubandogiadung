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
            'phone' => ['required', 'min:10'],
            'password' => ['required', 'min:8'],
            'repassword' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Please enter an email',
            'email.unique' => 'Email bị trùng',
            'email.email' => 'Please enter ...@gmail.com',
            'password.required' => 'Please enter an password',
            'password.min' => 'Password must be more than 8 characters',
            'name.required' => 'Please enter an name',
            'repassword' => 'Please enter an repassword',
            'phone.required' => 'Please enter an phone',
            'phone.min' => 'phone must be more than 10 characters'
        ];
    }
}
