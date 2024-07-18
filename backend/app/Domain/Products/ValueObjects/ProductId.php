<?php

namespace App\Domain\Products\ValueObjects;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class ProductId
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