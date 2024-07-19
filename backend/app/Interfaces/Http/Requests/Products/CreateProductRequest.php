<?php

namespace App\Interfaces\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array 
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The product name is required.',
            'price.required' => 'The product price is required.',
        ];
    }
}
