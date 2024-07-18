<?php

namespace App\Application\Command;

class CreateProductCommand
{
    public $name;
    public $price;

    public function __construct(string $name, float $price)
    {
        $this->name = $name;
        $this->price = $price;
    }
}