<?php

namespace App\Domain\Orders\ValueObjects;

use InvalidArgumentException;

class OrderQuantity
{
    private int $quantity;

    public function __construct(int $quantity)
    {
        if ($quantity < 0) {
            throw new InvalidArgumentException("Quantity cannot be negative: $quantity");
        }

        $this->quantity = $quantity;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function __toString(): string
    {
        return (string) $this->quantity;
    }
}
