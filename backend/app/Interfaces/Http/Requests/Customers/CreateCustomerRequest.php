<?php 

namespace App\Interfaces\Http\Requests\Customers;

use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerRequest extends FormRequest
{
    public function rules(): array 
    {
        return [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'firstName.required' => 'The customer first name is required.',
            'lastName.required' => 'The customer last name is required.',
            'address.required' => 'The customer address is required.',
            'email.required' => 'The customer email is required.',
            'phone.required' => 'The customer phone is required.',
        ];
    }
}