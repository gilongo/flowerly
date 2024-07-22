<?php 

namespace App\Application\Orders\Command;

class UpdateOrderCommand
{
    private $id;
    private $description;
    private $products;

    public function __construct(string $id, string $description, array $products)
    {
        $this->id = $id;
        $this->description = $description;
        $this->products = $products;
    }

    public function getId(): string
    {
        return $this->id;
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