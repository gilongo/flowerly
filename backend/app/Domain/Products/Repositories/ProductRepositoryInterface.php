<?php

namespace App\Domain\Products\Repositories;

use App\Domain\Products\Entities\Product;
use App\Domain\Products\ValueObjects\ProductId;

interface ProductRepositoryInterface
{
    public function findById(ProductId $id): ?Product;
    public function findAll(): array;
    public function save(Product $product): ProductId;
    public function delete(ProductId $id): void;
}