<?php 

namespace App\Domain\Customers\ValueObjects;

class CustomerPhone
{
    private $phone;

    public function __construct(string $phone)
    {
        $this->phone = $phone;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }
}