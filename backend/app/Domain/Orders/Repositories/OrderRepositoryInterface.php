<?php 

namespace App\Domain\Orders\Repositories;

use App\Domain\Orders\Entities\Order;
use App\Domain\Orders\ValueObjects\OrderId;

use Illuminate\Support\Collection;

interface OrderRepositoryInterface
{
    public function findById(OrderId $id): ?Order;
    public function findAll(array $filters = []): Collection;
    public function save(Order $order): OrderId;
    public function delete(OrderId $id): void;
}