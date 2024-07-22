<?php 

namespace App\Application\Orders\Handler;

use App\Application\Orders\Command\DeleteOrderCommand;
use App\Domain\Orders\Repositories\OrderRepositoryInterface;
use App\Domain\Orders\ValueObjects\OrderId;

class DeleteOrderHandler
{
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function handle(DeleteOrderCommand $command): void
    {
        $orderId = $command->getId();

        $order = $this->orderRepository->findById(new OrderId($orderId));

        if ($order === null) {
            throw new \Exception('Order not found');
        }

        $this->orderRepository->delete($order->getId());
    }
}