<?php

namespace App\Http\Requests\client;

use Illuminate\Foundation\Http\FormRequest;

class CheckFormOrderRequest extends FormRequest
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
            'phone' => [
                'required',
                'numeric'
            ],
            'email' => [
                'email'
            ],
            'address' => [
                'required',
                'string'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'name' => [
                'required' => 'Vui lòng nhập họ tên',
                'string' => 'Bắt buộc phải là một chuỗi'
            ],
            'phone' => [
                'required' => 'Vui lòng nhập số điện thoại',
                'numeric'=> 'Bắt buộc phải là số'
            ],
            'email' => [
                'email' => 'Phải là định dạng email'
            ],
            'address' => [
                'required' => 'Vui lòng nhập địa chỉ',
                'string' => 'Phải là một chuỗi'
            ]
        ];
    }
}
