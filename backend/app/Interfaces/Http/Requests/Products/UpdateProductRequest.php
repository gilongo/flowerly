<?php 

namespace App\Interfaces\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function rules(): array 
    {
        return [
            'name' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric'
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'Name must be a string',
            'price.numeric' => 'Price must be a number'
        ];
    }
}