<?php

namespace App\Application\Products\Command;

use App\Domain\Products\ValueObjects\ProductId;

class DeleteProductCommand
{
    private ProductId $id;

    public function __construct(ProductId $id)
    {
        $this->id = $id;
    }

    public function getId(): ProductId
    {
        return $this->id;
    }
}
