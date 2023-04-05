<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateVoucherFormRequest extends FormRequest
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
            'code' => ['required', 'min:4'],
            'name' => ['required'],
            'discount' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Please enter an code',
            'name.required' => 'Please enter an name',
            'code.min' => 'Code must be more than 4 characters',
            'discount.required' => 'Please enter an price',
            'discount.numeric' => 'Discount must be a number',
            'quantity.required' => 'Please enter an quantity',
            'quantity.numeric' => 'Quantity must be a number'
        ];
    }
}
