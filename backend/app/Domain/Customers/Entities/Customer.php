<?php

namespace App\Domain\Customers\Entities;

use App\Domain\Customers\ValueObjects\CustomerId;
use App\Domain\Customers\ValueObjects\CustomerFirstName;
use App\Domain\Customers\ValueObjects\CustomerLastName;
use App\Domain\Customers\ValueObjects\CustomerAddress;
use App\Domain\Customers\ValueObjects\CustomerEmail;
use App\Domain\Customers\ValueObjects\CustomerPhone;

class Customer
{

    private $id;
    private $firstName;
    private $lastName;
    private $address;
    private $email;
    private $phone;

    public function __construct(
        CustomerId $id,
        CustomerFirstName $firstName,
        CustomerLastName $lastName,
        CustomerAddress $address,
        CustomerEmail $email,
        CustomerPhone $phone
    ){

        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address = $address;
        $this->email = $email;
        $this->phone = $phone;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
}