<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductFormRequest extends FormRequest
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
            'price' => ['required', 'numeric'],
            'description' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Please enter an code',
            'name.required' => 'Please enter an name',
            'code.min' => 'Code must be more than 4 characters',
            'price.required' => 'Please enter an price',
            'price.numeric' => 'Price must be a number',
            'description.required' => 'Please enter an description'
        ];
    }
}
