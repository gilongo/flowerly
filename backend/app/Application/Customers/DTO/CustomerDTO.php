<?php 

namespace App\Application\Customers\DTO;

class CustomerDTO
{
    public $id;
    public $firstName;
    public $lastName;
    public $address;
    public $email;
    public $phone;

    public function __construct($id, $firstName, $lastName, $address, $email, $phone)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address = $address;
        $this->email = $email;
        $this->phone = $phone;
    }
}