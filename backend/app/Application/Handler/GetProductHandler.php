<?php

namespace App\Application\Handler;

use App\Application\DTO\ProductDTO;
use App\Application\Query\GetProductQuery;
use App\Domain\Products\Repositories\ProductRepositoryInterface;

class GetProductHandler
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(GetProductQuery $query): ProductDTO
    {
        $product = $this->productRepository->findById($query->getId());

        if ($product === null) {
            throw new \Exception('Product not found');
        }
       
        return new ProductDTO(
                $product->getId()->getId(), 
                $product->getName()->getName(), 
                $product->getPrice()->getPrice()
        );
    }
}