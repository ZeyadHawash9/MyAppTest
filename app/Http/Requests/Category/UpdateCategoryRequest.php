<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'image' => 'image|mimes:png,jpg,jpeg|max:2048',
            'name' => 'required',
            'description' => 'required',


        ];
    }
    public function messages(): array
    {
        return [
            'image.image' => 'The image must be an image.',
            'image.mimes' => 'The image must be a file of type: :values.',
            'image.max' => 'The image may not be greater than :max kilobytes.',
            'name.required' => 'The name field is required.',
            'description.required' => 'The description field is required.',
        ];
    }
}
