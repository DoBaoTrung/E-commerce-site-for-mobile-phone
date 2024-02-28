<?php

namespace App\Http\Requests\client\auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CheckRegisterRequest extends FormRequest
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
            'first_name' => [
                'required',
                'string'
            ],
            'last_name' => [
                'required',
                'string'
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email'
            ],
            'gender' => [
                'required',
                'boolean'
            ],
            'birthdate' => [
                'required',
                'date',
                'before:today'
            ],
            'phone' => [
                'required',
                'numeric'
            ],
            'address' => [
                'required',
                'string'
            ],
            'password' => [
                'required',
                'string',
                'min:4',
                'max:10',
                // 'confirmed'
            ],
            'confirm_password' => [
                'required',
                'string',
                'min:4',
                'max:10',
                'same:password'
            ],
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
