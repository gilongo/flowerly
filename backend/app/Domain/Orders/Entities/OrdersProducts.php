<?php 

namespace App\Domain\Orders\Entities;

use App\Domain\Orders\ValueObjects\OrderId;
use App\Domain\Products\Entities\Product;

class OrdersProducts
{
    private $id;
    private $orderId;
    private $product;
    private $quantity;

    public function __construct(OrderId $orderId, Product $product, int $quantity)
    {
        $this->orderId = $orderId;
        $this->product = $product;
        $this->quantity = $quantity;
    }
    
    public function getOrderId(): OrderId
    {
        return $this->orderId;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }
}