<?php 

namespace App\Infrastructure\Persistance\Eloquent;

use App\Domain\Orders\Entities\Order;
use App\Domain\Orders\Repositories\OrderRepositoryInterface;
use App\Domain\Orders\ValueObjects\OrderId;
use App\Domain\Orders\ValueObjects\OrderDescription;
use App\Domain\Orders\ValueObjects\OrderTotalPrice;

use App\Models\Order as EloquentOrder;
use Illuminate\Support\Collection;

class EloquentOrderRepository implements OrderRepositoryInterface
{
    public function findById(OrderId $id): ?Order
    {
        //
    }

    public function findAll(): array
    {
        return EloquentOrder::with('products')->get()->map(function ($eloquentOrder) {
            return $this->mapToDomain($eloquentOrder);
        })->toArray();
    }

    public function save(Order $order): OrderId
    {
        $eloquentOrder = EloquentOrder::find($order->getId()->getId());

        if ($eloquentOrder === null) {
            $eloquentOrder = new EloquentOrder();
            $eloquentOrder->id = $order->getId()->getId();
        }

        $eloquentOrder->customer_id = $order->getCustomer()->getId()->getId();
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
        //
    }

    private function mapToDomain(EloquentOrder $eloquentOrder)
    {
        $order = [
            'id' => $eloquentOrder->id,
            'customer_id' => $eloquentOrder->customer_id,
            'description' => $eloquentOrder->description,
            'total_price' => $eloquentOrder->total_price,
            'products' => $eloquentOrder->products->map(function ($eloquentProduct) {
                return [
                    'product_id' => $eloquentProduct->id,
                    'name' => $eloquentProduct->name,
                    'price' => $eloquentProduct->price,
                    'quantity' => $eloquentProduct->pivot->quantity,
                ];
            })->toArray(),
        ];
        return $order;
    }
}