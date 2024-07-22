<?php 

namespace App\Application\Orders\Handler;

use App\Application\Orders\Query\GetAllOrdersQuery;
use App\Application\Orders\DTO\OrderDTO;
use App\Domain\Orders\Repositories\OrderRepositoryInterface;

use DateTime;

class GetAllOrdersHandler
{
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function handle(GetAllOrdersQuery $query): array
    {
        $filters = [];
        if ($query->getDescription()) {
            $filters['description'] = $query->getDescription();
        }
        if ($query->getProductName()) {
            $filters['product_name'] = $query->getProductName();
        }
        if($query->getDateFrom()) {
            $filters['date_from'] = $query->getDateFrom();
        }
        if($query->getDateTo()) {
            $filters['date_to'] = $query->getDateTo();
        }

        $orders = $this->orderRepository->findAll($filters);

        $orderDTOs = $orders->map(function ($order) {
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
                $order->getTotalPrice(),
                $order->getCreatedAt()
            );
        });

        return $orderDTOs->toArray();

    }
}