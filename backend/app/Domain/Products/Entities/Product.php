<?php

namespace App\Domain\Products\Entities;

use App\Domain\Products\ValueObjects\ProductId;
use App\Domain\Products\ValueObjects\ProductName;
use App\Domain\Products\ValueObjects\ProductPrice;

class Product
{
    private $id;
    private $name;
    private $price;

    public function __construct(ProductId $id, ProductName $name, ProductPrice $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice(ProductPrice $price)
    {
        $this->price = $price;
    }

    public function setName(ProductName $name)
    {
        $this->name = $name;
    }
}