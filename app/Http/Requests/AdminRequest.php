<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
          'avatar' => 'image|mimes:png,jpg,jpeg|max:2048', // Validate image file
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'user_email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8', // Adjust minimum password length as needed
      
        ];
    }
     /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'avatar.image' => 'The :attribute must be an image.',
            'avatar.mimes' => 'The :attribute must be a file of type: :values.',
            'avatar.max' => 'The :attribute may not be greater than :max kilobytes.',
            'name.required' => 'The :attribute field is required.',
            'name.string' => 'The :attribute must be a string.',
            'name.max' => 'The :attribute may not be greater than :max characters.',
            'username.required' => 'The :attribute field is required.',
            'username.string' => 'The :attribute must be a string.',
            'username.max' => 'The :attribute may not be greater than :max characters.',
            'phone_number.required' => 'The :attribute field is required.',
            'phone_number.string' => 'The :attribute must be a string.',
            'phone_number.max' => 'The :attribute may not be greater than :max characters.',
            'user_email.required' => 'The :attribute field is required.',
            'user_email.email' => 'The :attribute must be a valid email address.',
            'user_email.unique' => 'The :attribute has already been taken.',
            'password.required' => 'The :attribute field is required.',
            'password.string' => 'The :attribute must be a string.',
            'password.min' => 'The :attribute must be at least :min characters.',
        ];
    }
}
