<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust the authorization logic if needed
    }

    public function rules()
    {
        return [
            'email_user' => 'required|email|max:50|unique:tbl_user',
            'password' => 'required|min:6',
            'role' => 'required|in:Ketua DKM,Bendahara,Warga Sekolah',
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the image validation rules
        ];
    }

    public function messages()
    {
        return [
            'email_user.required' => 'Email is required.',
            'email_user.email' => 'Invalid email format.',
            'email_user.max' => 'Email must not exceed 50 characters.',
            'email_user.unique' => 'Email is already registered.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters.',
            'role.required' => 'Role is required.',
            'role.in' => 'Invalid role selected.',
            'foto_profil.required' => 'Profile picture is required.',
            'foto_profil.image' => 'Profile picture must be an image.',
            'foto_profil.mimes' => 'Supported image formats: jpeg, png, jpg, gif.',
            'foto_profil.max' => 'Maximum file size allowed is 2MB.',
        ];
    }
}
