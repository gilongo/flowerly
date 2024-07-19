<?php

namespace App\Domain\Customers\ValueObjects;

class CustomerAddress 
{
    private $address;

    public function __construct(string $address)
    {
        $this->address = $address;
    }

    public function getAddress(): string
    {
        return $this->address;
    }
}