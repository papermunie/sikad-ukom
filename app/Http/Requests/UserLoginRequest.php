<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust the authorization logic if needed
    }

    public function rules()
    {
        return [
            'email_user' => 'required|email|max:50',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email_user.required' => 'Email is required.',
            'email_user.email' => 'Invalid email format.',
            'email_user.max' => 'Email must not exceed 50 characters.',
            'password.required' => 'Password is required.',
        ];
    }
}
