<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PropertyFormRequest extends FormRequest
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
            'title' => ['required', 'min:8'],
            'description' => ['required', 'min:8'],
            'surface' => ['required', 'integer', 'min:8'],
            'rooms' => ['required', 'integer', 'min:1'],
            'bedrooms' => ['required', 'integer', 'min:1'],
            'floor' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'integer', 'min:0'],
            'city' => ['required', 'min:3'],
            'address' => ['required', 'min:8'],
            'postal_code' => ['required', 'min:5'],
            'sold' => ['required', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'El título es obligatorio.',
            'description.required' => 'La descripción es obligatoria.',
            'surface.required' => 'La superficie es obligatoria.',
            // Agrega más mensajes de error personalizados aquí
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Título',
            'description' => 'Descripción',
            'surface' => 'Superficie',
            // Agrega más nombres de campo personalizados aquí
        ];
    }
}
