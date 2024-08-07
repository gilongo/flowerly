<?php 

namespace App\Application\Orders\DTO;

use Illuminate\Support\Collection;
use DateTime;
use JsonSerializable;

class OrderDTO implements JsonSerializable
{
    private $id;
    private $customerId;
    private $description;
    private $products;
    private $totalPrice;
    private $createdAt;

    public function __construct(string $id, string $customerId, string $description, Collection $products, float $totalPrice, string $createdAt)
    {
        $this->id = $id;
        $this->customerId = $customerId;
        $this->description = $description;
        $this->products = $products;
        $this->totalPrice = $totalPrice;
        $this->createdAt = $createdAt;
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

    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'customerId' => $this->customerId,
            'description' => $this->description,
            'products' => $this->products,
            'totalPrice' => $this->totalPrice,
            'createdAt' => $this->createdAt
        ];
    }
}