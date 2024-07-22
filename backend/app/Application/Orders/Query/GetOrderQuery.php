<?php 

namespace App\Application\Orders\Query;

use App\Domain\Orders\ValueObjects\OrderId;

class GetOrderQuery
{
    private OrderId $id;    

    public function __construct(OrderId $id)
    {
        $this->id = $id;
    }

    public function getId(): OrderId
    {
        return $this->id;
    }
}