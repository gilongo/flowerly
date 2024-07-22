<?php 

namespace App\Application\Orders\Handler;

use App\Application\Orders\Command\CreateOrderCommand;
use App\Application\Orders\DTO\OrderDTO;
use App\Domain\Orders\Entities\Order;
use App\Domain\Orders\Repositories\OrderRepositoryInterface;
use App\Domain\Orders\Entities\OrdersProducts;
use App\Domain\Orders\ValueObjects\OrderId;
use App\Domain\Orders\ValueObjects\OrderDescription;
use App\Domain\Customers\ValueObjects\CustomerId;
use App\Domain\Products\ValueObjects\ProductId;
use App\Domain\Products\Repositories\ProductRepositoryInterface;
use App\Domain\Customers\Repositories\CustomerRepositoryInterface;

class CreateOrderHandler
{
    private $orderRepository;
    private $productRepository;
    private $customerRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        ProductRepositoryInterface $productRepository,
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
        $this->customerRepository = $customerRepository;
    }

    public function handle(CreateOrderCommand $command): OrderDTO
    {
        $customer = $this->customerRepository->findById(new CustomerId($command->getCustomerId()));
        if ($customer === null) {
            throw new \Exception('Customer not found');
        }

        $ordersProducts = [];
        foreach ($command->getProducts() as $productData) {
            $product = $this->productRepository->findById(new ProductId($productData['id']));
            if ($product === null) {
                throw new \Exception("Product not found: " . $productData['id']);
            }

            $ordersProducts[] = new OrdersProducts(
                OrderId::generate(),
                $product,
                $productData['quantity']
            );
        }

        $order = new Order(
            OrderId::generate(),
            $customer,
            new OrderDescription($command->getDescription()),
            $ordersProducts
        );

        $orderDTO = new OrderDTO(
            $this->orderRepository->save($order),
            $order->getCustomer()->getId()->getId(),
            $order->getDescription()->getDescription(),
            array_map(function (OrdersProducts $ordersProducts) {
                return [
                    'product' => $ordersProducts->getProduct()->getId()->getId(),
                    'quantity' => $ordersProducts->getQuantity(),
                ];
            }, $order->getProducts()),
            $order->getTotalPrice()
        );

        return $orderDTO;
    }
}