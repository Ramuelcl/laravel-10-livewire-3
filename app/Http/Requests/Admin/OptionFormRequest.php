<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OptionFormRequest extends FormRequest
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
            'name' => ['required', 'min:3'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The :attribute field is required.',
            'name.min' => 'The :attribute field must be at least :min characters.',

            // Add more custom error messages here
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nombre',
            // Agrega más nombres de campo personalizados aquí
        ];
    }
}
