<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderFormRequest extends FormRequest
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
            'phone' => ['required', 'numeric', 'min:10', 'regex:/(0)[0-9]{9}/'],
            'country' => ['required'],
            'city' => ['required'],
            'ward' => ['required'],
            'homenumber' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'phone.required' => 'Không được để trống ô này',
            'name.required' => 'Không được để trống ô này',
            'country.required' => 'Không được để trống ô này',
            'city.required' => 'Không được để trống ô này',
            'ward.required' => 'Không được để trống ô này',
            'homenumber.required' => 'Không được để trống ô này',
            'phone.regex' => 'Nhập đúng định dạng số điện thoại',
            'phone.numeric' => 'Nhập đúng định dạng số điện thoại',
            'phone.min' => 'Số Điện Thoại phải trên 10 số',
        ];
    }
}
