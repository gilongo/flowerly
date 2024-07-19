<?php 

namespace App\Application\Products\Handler;

use App\Application\Products\Command\UpdateProductCommand;
use App\Application\Products\DTO\ProductDTO;
use App\Domain\Products\Repositories\ProductRepositoryInterface;
use App\Domain\Products\ValueObjects\ProductId;
use App\Domain\Products\ValueObjects\ProductName;
use App\Domain\Products\ValueObjects\ProductPrice;
use App\Domain\Products\Entities\Product;

class UpdateProductHandler
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(UpdateProductCommand $command): ProductDTO
    {
        $productId = new ProductId($command->getId());
        $product = $this->productRepository->findById($productId);

        if ($product === null) {
            throw new \Exception('Product not found');
        }

        if($command->getName() !== null) {
            $product->setName(new ProductName($command->getName()));
        }

        if($command->getPrice() !== null) {
            $product->setPrice(new ProductPrice($command->getPrice()));
        }

        $this->productRepository->save($product);

        return new ProductDTO(
            $product->getId()->getId(),
            $product->getName()->getName(),
            $product->getPrice()->getPrice()
        );
    }
}
