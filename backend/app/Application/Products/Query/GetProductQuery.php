<?php

namespace App\Application\Products\Query;

use App\Domain\Products\ValueObjects\ProductId;

class GetProductQuery
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