<?php 

namespace App\Application\Customers\Command;

class CreateCustomerCommand
{
    public $firstName;
    public $lastName;
    public $address;
    public $email;
    public $phone;

    public function __construct(
        string $firstName, 
        string $lastName, 
        string $address, 
        string $email, 
        string $phone
        )
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address = $address;
        $this->email = $email;
        $this->phone = $phone;
    }
}