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
            'phone' => ['required', 'min:10'],
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
            'country.required' => 'Không được để trống ô này',
            'city.required' => 'Không được để trống ô này',
            'ward.required' => 'Không được để trống ô này',
            'homenumber.required' => 'Không được để trống ô này',
            'phone.min' => 'Số Điện Thoại phải trên 10 số',
        ];
    }
}
