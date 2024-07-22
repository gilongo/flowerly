<?php 

namespace App\Interfaces\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'customer_id' => 'required|string',
            'description' => 'required|string',
            'products' => 'required|array',
            'products.*.id' => 'required|string',
            'products.*.quantity' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'customer_id.required' => 'The customer ID is required.',
            'description.required' => 'The description is required.',
            'products.required' => 'The products are required.',
            'products.array' => 'The products must be an array.',
            'products.*.id.required' => 'Each product must have an ID.',
            'products.*.quantity.required' => 'Each product must have a quantity.',
            'products.*.quantity.integer' => 'Each product quantity must be an integer.',
            'products.*.quantity.min' => 'Each product quantity must be at least 1.',
        ];
    }
}