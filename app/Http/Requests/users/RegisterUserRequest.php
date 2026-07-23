<?php

namespace App\Http\Requests\users;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ];
    }

     public function messages(): array
    {
        return [
            'name.required' => 'name is required.',
            'email.required' => 'email is required.',
            'email.email' => 'email must be a valid email',
            'password.required' => 'password is required.',
            'password.min' => 'password must be at least 8 characters.',
        ];
    }
}
