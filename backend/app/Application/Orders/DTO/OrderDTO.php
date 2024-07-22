<?php 

namespace App\Application\Orders\DTO;

use JsonSerializable;

class OrderDTO implements JsonSerializable
{
    private $id;
    private $customerId;
    private $description;
    private $products;
    private $totalPrice;

    public function __construct(string $id, string $customerId, string $description, array $products, float $totalPrice)
    {
        $this->id = $id;
        $this->customerId = $customerId;
        $this->description = $description;
        $this->products = $products;
        $this->totalPrice = $totalPrice;
    }

    public function getId(): string
    {
        return $this->id;
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

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'customerId' => $this->customerId,
            'description' => $this->description,
            'products' => $this->products,
            'totalPrice' => $this->totalPrice,
        ];
    }
}