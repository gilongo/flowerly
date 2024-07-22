<?php 

namespace App\Application\Orders\Handler;

use App\Application\Orders\DTO\OrderDTO;
use App\Application\Orders\Query\GetOrderQuery;
use App\Domain\Orders\Repositories\OrderRepositoryInterface;

class GetOrderHandler
{
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function handle(GetOrderQuery $query): OrderDTO
    {
        $order = $this->orderRepository->findById($query->getId());

        if ($order === null) {
            throw new \Exception('Order not found');
        }   

        return new OrderDTO(
            $order->getId()->getId(),
            $order->getCustomerId()->getId(),
            $order->getDescription()->getDescription(),
            $order->getProducts()->map(function ($orderProduct) {
                return [
                    'product' => [
                        'id' => $orderProduct->getProduct()->getId()->getId(),
                        'name' => $orderProduct->getProduct()->getName()->getName(),
                        'price' => $orderProduct->getProduct()->getPrice()->getPrice(),
                    ],
                    'quantity' => $orderProduct->getQuantity(),
                ];
            }),
            $order->getTotalPrice()
        );
    }
}