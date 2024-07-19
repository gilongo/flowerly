<?php

namespace App\Application\Products\Handler;

use App\Application\Products\Command\DeleteProductCommand;
use App\Domain\Products\Repositories\ProductRepositoryInterface;

class DeleteProductHandler
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(DeleteProductCommand $command): void
    {
        $productId = $command->getId();

        $product = $this->productRepository->findById($productId);

        if ($product === null) {
            throw new \Exception('Product not found');
        }

        $this->productRepository->delete($product->getId());
    }
}
