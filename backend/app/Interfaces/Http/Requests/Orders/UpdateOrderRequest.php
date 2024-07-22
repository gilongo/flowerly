<?php 

namespace App\Interfaces\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'description' => 'sometimes|required|string',
            'products' => 'sometimes|required|array',
            'products.*.id' => 'sometimes|required|string',
            'products.*.quantity' => 'sometimes|required|integer|min:0',
        ];

    }

    public function messages(): array
    {
        return [
            'products.array' => 'The products must be an array.',
            'products.*.id.required' => 'Each product must have an ID.',
            'products.*.quantity.required' => 'Each product must have a quantity.',
            'products.*.quantity.integer' => 'Each product quantity must be an integer.',
            'products.*.quantity.min' => 'Each product quantity must be greater than 0.',
        ];
    }
}
