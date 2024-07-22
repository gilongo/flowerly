<?php 

namespace App\Domain\Orders\Entities;

use App\Domain\Customers\Entities\Customer;
use App\Domain\Orders\ValueObjects\OrderId;
use App\Domain\Orders\ValueObjects\OrderDescription;

class Order 
{
    private $id;
    private $customer;
    private $description;
    private $products;
    private $totalPrice;

    public function __construct(OrderId $id, Customer $customer, OrderDescription $description, array $products)
    {
        $this->id = $id;
        $this->customer = $customer;
        $this->description = $description;
        $this->products = $products;
        $this->calculateTotalePrice();
    }

    private function calculateTotalePrice(): void 
    {
        $this->totalPrice = array_reduce($this->products, function($total, OrdersProducts $ordersProducts) {
            return $total + ($ordersProducts->getQuantity() * $ordersProducts->getProduct()->getPrice()->getPrice());
        }, 0);
    }

    public function getId(): OrderId
    {
        return $this->id;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function getDescription()
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
}