<?php

namespace App\Application\Handler;

use App\Application\Command\CreateProductCommand;
use App\Domain\Products\Entities\Product;
use App\Domain\Products\Repositories\ProductRepositoryInterface;
use App\Domain\Products\ValueObjects\ProductId;
use App\Domain\Products\ValueObjects\ProductName;
use App\Domain\Products\ValueObjects\ProductPrice;

class CreateProductHandler
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(CreateProductCommand $command): ProductId
    {
        $product = new Product(
            ProductId::generate(),
            new ProductName($command->name),
            new ProductPrice($command->price)
        );

        $this->productRepository->save($product);
        return $product->getId();
    }
}