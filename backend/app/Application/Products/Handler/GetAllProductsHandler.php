<?php 

namespace App\Application\Products\Handler;

use App\Application\Products\DTO\ProductDTO;
use App\Application\Products\Query\GetAllProductsQuery;
use App\Domain\Products\Repositories\ProductRepositoryInterface;

class GetAllProductsHandler
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(GetAllProductsQuery $query): array
    {
        $products = $this->productRepository->findAll();
       
        $productDTOs = array_map(function ($product) {
            return new ProductDTO(
                $product->getId()->getId(), 
                $product->getName()->getName(), 
                $product->getPrice()->getPrice()
            );
        }, $products);

        return $productDTOs;
    }
}