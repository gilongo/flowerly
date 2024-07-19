<?php

namespace App\Domain\Customers\ValueObjects;

class CustomerFirstName
{
    private $firstName;

    public function __construct(string $firstName)
    {
        $this->firstName = $firstName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }
}