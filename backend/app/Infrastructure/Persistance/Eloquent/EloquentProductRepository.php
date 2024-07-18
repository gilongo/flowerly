<?php

namespace App\Infrastructure\Persistance\Eloquent;

use App\Domain\Products\Entities\Product;
use App\Domain\Products\Repositories\ProductRepositoryInterface;
use App\Domain\Products\ValueObjects\ProductId;
use App\Domain\Products\ValueObjects\ProductName;
use App\Domain\Products\ValueObjects\ProductPrice;
use App\Models\Product as EloquentProduct;

class EloquentProductRepository implements ProductRepositoryInterface
{
    public function findById(ProductId $id): ?Product
    {
        $eloquentProduct = EloquentProduct::find($id->getId());
        if($eloquentProduct){
            return new Product(
                new ProductId($id->getId()), 
                new ProductName($eloquentProduct->name), 
                new ProductPrice($eloquentProduct->price)
            );
        }

        return null;
    }

    public function findAll(): array
    {
        $eloquentProducts = EloquentProduct::all();
        $products = array_map(function ($product)  {
            return new Product(
                new ProductId($product['id']), 
                new ProductName($product['name']), 
                new ProductPrice($product['price'])
            );
        }, $eloquentProducts->toArray());
        return $products;
    }

    public function save(Product $product): ProductId
    {
        $eloquentProduct = EloquentProduct::updateOrCreate(
            ['id' => $product->getId()->getId()],
            [
                'name' => $product->getName()->getName(), 
                'price' => $product->getPrice()->getPrice()
            ]
        );

        return new ProductId($eloquentProduct->id);
    }

    public function delete(ProductId $id): void
    {
        EloquentProduct::destroy($id->getId());
    }
}