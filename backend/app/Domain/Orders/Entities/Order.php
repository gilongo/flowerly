<?php 

namespace App\Domain\Orders\Entities;

use App\Domain\Customers\ValueObjects\CustomerId;
use App\Domain\Orders\ValueObjects\OrderId;
use App\Domain\Orders\ValueObjects\OrderDescription;

use App\Domain\Products\Entities\Product;

use Illuminate\Support\Collection;

class Order 
{
    private $id;
    private $customerId;
    private $description;
    private $products;
    private $totalPrice;

    public function __construct(OrderId $id, CustomerId $customerId, OrderDescription $description)
    {
        $this->id = $id;
        $this->customerId = $customerId;
        $this->description = $description;
        $this->products = new Collection();
    }

    public function getId(): OrderId
    {
        return $this->id;
    }

    public function getCustomerId(): CustomerId
    {
        return $this->customerId;
    }

    public function getDescription()
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

    public function calculateTotalPrice(): void
    {
        $total = 0;
        foreach ($this->products as $orderProduct) {
            $total += $orderProduct->getProduct()->getPrice()->getPrice() * $orderProduct->getQuantity();
        }
        $this->totalPrice = $total;
    }

    public function addProduct(Product $product, int $quantity): void
    {
        $existingOrderProduct = $this->products->first(function(OrdersProducts $ordersProducts) use ($product) {
            return $ordersProducts->getProduct()->getId()->getId() === $product->getId()->getId();
        });

        if($existingOrderProduct) {
            $existingOrderProduct->setQuantity($existingOrderProduct->getQuantity() + $quantity);
        } else {
            $this->products->push(new OrdersProducts($this->id, $product, $quantity));
        }

        $this->calculateTotalPrice();
    }
}