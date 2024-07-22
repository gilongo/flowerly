<?php

namespace App\Domain\Orders\ValueObjects;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

class OrderId
{
    private string $id;

    public function __construct(string $id)
    {
        if (!Uuid::isValid($id)) {
            throw new InvalidArgumentException("Invalid UUID: $id");
        }

        $this->id = $id;
    }

    public static function generate(): self
    {
        return new self(Uuid::uuid4()->toString());
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
