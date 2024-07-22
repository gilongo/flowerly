<?php

namespace App\Domain\Orders\ValueObjects;

use InvalidArgumentException;

class OrderTotalPrice
{
    private float $price;

    public function __construct(float $price)
    {
        if ($price < 0) {
            throw new InvalidArgumentException("Price cannot be negative: $price");
        }

        $this->price = $price;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function __toString(): string
    {
        return (string) $this->price;
    }
}
