<?php 

namespace App\Application\Orders\Query;

class GetAllOrdersQuery
{
    private ?string $description;
    private ?string $product_name;

    public function __construct(?string $description = null, ?string $product_name = null)
    {
        $this->description = $description;
        $this->product_name = $product_name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getProductName(): ?string
    {
        return $this->product_name;
    }
}