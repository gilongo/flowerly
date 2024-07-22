<?php 

namespace App\Application\Orders\Command;

class CreateOrderCommand
{
    private $customerId;
    private $description;
    private $products;

    public function __construct(string $customerId, string $description, array $products)
    {
        $this->customerId = $customerId;
        $this->description = $description;
        $this->products = $products;
    }

    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getProducts(): array
    {
        return $this->products;
    }
}