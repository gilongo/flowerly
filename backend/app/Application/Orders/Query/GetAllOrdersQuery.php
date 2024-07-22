<?php 

namespace App\Application\Orders\Query;

class GetAllOrdersQuery
{
    private ?string $description;
    private ?string $product_name;
    private ?string $date_from;
    private ?string $date_to;

    public function __construct(?string $description = null, ?string $product_name = null, ?string $date_from = null, ?string $date_to = null)
    {
        $this->description = $description;
        $this->product_name = $product_name;
        $this->date_from = $date_from;
        $this->date_to = $date_to;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getProductName(): ?string
    {
        return $this->product_name;
    }

    public function getDateFrom(): ?string
    {
        return $this->date_from;
    }

    public function getDateTo(): ?string
    {
        return $this->date_to;
    }
}