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
            'title.required' => 'The :attribute field is required.',
            'title.min' => 'The :attribute field must be at least :min characters.',
            'description.required' => 'The :attribute field is required.',
            'description.min' => 'The :attribute field must be at least :min characters.',
            'surface.required' => 'The :attribute field is required.',
            'surface.integer' => 'The :attribute field must be an integer.',
            'surface.min' => 'The :attribute field must be at least :min.',
            'rooms.required' => 'The :attribute field is required.',
            'rooms.integer' => 'The :attribute field must be an integer.',
            'rooms.min' => 'The :attribute field must be at least :min.',
            'bedrooms.required' => 'The :attribute field is required.',
            'bedrooms.integer' => 'The :attribute field must be an integer.',
            'bedrooms.min' => 'The :attribute field must be at least :min.',
            'floor.required' => 'The :attribute field is required.',
            'floor.integer' => 'The :attribute field must be an integer.',
            'floor.min' => 'The :attribute field must be at least :min.',
            'price.required' => 'The :attribute field is required.',
            'price.integer' => 'The :attribute field must be an integer.',
            'price.min' => 'The :attribute field must be at least :min.',
            'city.required' => 'The :attribute field is required.',
            'city.min' => 'The :attribute field must be at least :min characters.',
            'address.required' => 'The :attribute field is required.',
            'address.min' => 'The :attribute field must be at least :min characters.',
            'postal_code.required' => 'The :attribute field is required.',
            'postal_code.min' => 'The :attribute field must be at least :min characters.',
            'sold.required' => 'The :attribute field is required.',
            'sold.boolean' => 'The :attribute field must be true or false.',
            // Add more custom error messages here
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Título',
            'description' => 'Descripción',
            'surface' => 'Superficie',
            'rooms' => 'Habitaciones',
            'bedrooms' => 'Dormitorios',
            'floor' => 'pisos',
            'price' => 'precio',
            'city' => 'ciudad',
            'address' => 'direccion',
            'postal_code' => 'código postal',
            'sold' => 'vendido',
            // Agrega más nombres de campo personalizados aquí
        ];
    }
}
