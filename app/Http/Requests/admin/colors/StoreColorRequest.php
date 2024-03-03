<?php

namespace App\Http\Requests\admin\colors;

use Illuminate\Foundation\Http\FormRequest;

class StoreColorRequest extends FormRequest
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
            'color_name' => [
                'required',
                'string',
                'unique:colors,color_name'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'color_name' => [
                'required' => 'Vui lòng nhập tên màu sắc',
                'string' => 'Bắt buộc phải là chuỗi'
            ]
        ];
    }
}
