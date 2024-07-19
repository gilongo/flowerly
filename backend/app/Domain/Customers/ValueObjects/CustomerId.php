<?php

namespace App\Domain\Customers\ValueObjects;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class CustomerId
{
    private $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public static function generate(): self
    {
        $uuid = Uuid::uuid4();
        return new self($uuid->toString());
    }

    public function getId(): string
    {
        return $this->id;
    }

}