<?php 

namespace App\Infrastructure\Persistance\Eloquent;

use App\Domain\Orders\Entities\Order;
use App\Domain\Orders\Repositories\OrderRepositoryInterface;
use App\Domain\Orders\ValueObjects\OrderId;
use App\Domain\Orders\ValueObjects\OrderDescription;
use App\Domain\Orders\ValueObjects\OrderTotalPrice;
use App\Domain\Orders\ValueObjects\OrderQuantity;

use App\Domain\Orders\Entities\OrdersProducts;

use App\Domain\Customers\ValueObjects\CustomerId;

use App\Domain\Products\Entities\Product;
use App\Domain\Products\ValueObjects\ProductId;
use App\Domain\Products\ValueObjects\ProductName;
use App\Domain\Products\ValueObjects\ProductPrice;

use App\Models\Order as EloquentOrder;
use App\Models\Product as EloquentProduct;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use DateTime;

class EloquentOrderRepository implements OrderRepositoryInterface
{
    public function findById(OrderId $id): ?Order
    {
        $eloquentOrder = EloquentOrder::with('products')->find($id->getId());
        if ($eloquentOrder === null) {
            return null;
        }

        return $this->mapToDomain($eloquentOrder);
    }

    public function findAll(array $filters = []): Collection
    {
        $query = EloquentOrder::with('products');

        if (isset($filters['description'])) {
            $query->where('description', 'like', '%' . $filters['description'] . '%');
        }

        if (isset($filters['product_name'])) {
            $query->whereHas('products', function (Builder $query) use ($filters) {
                $query->where('name', 'like', '%' . $filters['product_name'] . '%');
            });
        }

        if (isset($filters['date_from'])) {
            $query->where('created_at', '>=', $filters['date_from']);
        }

        if (isset($filters['date_to'])) {
            $query->where('created_at', '<=', $filters['date_to']);
        }

        return $query->get()->map(function ($eloquentOrder) {
            return $this->mapToDomain($eloquentOrder);
        });
    }

    public function save(Order $order): OrderId
    {
        $eloquentOrder = EloquentOrder::find($order->getId()->getId());

        if ($eloquentOrder === null) {
            $eloquentOrder = new EloquentOrder();
            $eloquentOrder->id = $order->getId()->getId();
        }

        $eloquentOrder->customer_id = $order->getCustomerId()->getId();
        $eloquentOrder->description = $order->getDescription()->getDescription();
        $eloquentOrder->total_price = $order->getTotalPrice();

        $productsData = [];
        foreach ($order->getProducts() as $item) {
            $productsData[$item->getProduct()->getId()->getId()] = ['quantity' => $item->getQuantity()];
        }

        $eloquentOrder->save();

        $eloquentOrder->products()->sync($productsData);

        return $order->getId();
    }

    public function delete(OrderId $id): void
    {
        EloquentOrder::destroy($id->getId());
    }

    private function mapToDomain(EloquentOrder $eloquentOrder)
    {
        $order = new Order(
            new OrderId($eloquentOrder->id),
            new CustomerId($eloquentOrder->customer_id),
            new OrderDescription($eloquentOrder->description),
            DateTime::createFromFormat('Y-m-d H:i:s', $eloquentOrder->created_at),
        );

        foreach ($eloquentOrder->products as $product) {
            $order->updateProducts(
                new Product(
                    new ProductId($product->id),
                    new ProductName($product->name),
                    new ProductPrice($product->price)
                ),
                $product->pivot->quantity
            );
        }

        return $order;
    }
}