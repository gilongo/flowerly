<?php 

namespace App\Application\Orders\Handler;

use App\Application\Orders\Query\GetAllOrdersQuery;
use App\Application\Orders\DTO\OrderDTO;
use App\Domain\Orders\Repositories\OrderRepositoryInterface;

class GetAllOrdersHandler
{
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function handle(GetAllOrdersQuery $query): array
    {
        return $this->orderRepository->findAll();
    }
}