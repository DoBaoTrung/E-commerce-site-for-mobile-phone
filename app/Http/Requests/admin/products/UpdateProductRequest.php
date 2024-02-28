<?php

namespace App\Http\Requests\admin\products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string'
            ],
            'avatar' => [
                'nullable',
                'image',
                'file'
            ],
            'price' => [
                'required',
                'numeric'
            ],
            'description' => [
                'nullable',
                'string'
            ],
            'manufacturer_id' => [
                'required',
                'numeric'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            
        ];
    }
}
