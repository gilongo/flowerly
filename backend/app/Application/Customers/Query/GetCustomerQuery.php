<?php 

namespace App\Application\Customers\Query;

use App\Domain\Customers\ValueObjects\CustomerId;

class GetCustomerQuery
{
    private CustomerId $id;

    public function __construct(CustomerId $id)
    {
        $this->id = $id;
    }

    public function getId(): CustomerId
    {
        return $this->id;
    }
}