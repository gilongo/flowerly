<?php

namespace App\Domain\Customers\ValueObjects;

class CustomerLastName
{
    private $lastName;

    public function __construct(string $lastName)
    {
        $this->lastName = $lastName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }
}