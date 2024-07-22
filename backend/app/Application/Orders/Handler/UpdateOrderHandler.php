<?php 

namespace App\Application\Orders\Handler;

use App\Application\Orders\Command\UpdateOrderCommand;
use App\Domain\Orders\Entities\Order;
use App\Application\Orders\DTO\OrderDTO;
use App\Domain\Orders\Repositories\OrderRepositoryInterface;
use App\Domain\Products\Repositories\ProductRepositoryInterface;
use App\Domain\Orders\ValueObjects\OrderId;
use App\Domain\Products\Entities\Product;
use App\Domain\Orders\Entities\OrdersProducts;
use App\Domain\Orders\ValueObjects\OrderDescription;
use App\Domain\Products\ValueObjects\ProductId;

use Illuminate\Support\Collection;

class UpdateOrderHandler
{
    private $orderRepository;
    private $productRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        ProductRepositoryInterface $productRepository,
    ) {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
    }

    public function handle(UpdateOrderCommand $command): ?OrderDTO
    {
        $order = $this->orderRepository->findById(new OrderId($command->getId()));

        if (!$order) {
            throw new \Exception("Order not found");
        }

        $ordersProducts = [];
        foreach ($command->getProducts() as $productData) {
            $product = $this->productRepository->findById(new ProductId($productData['id']));
            if ($product === null) {
                throw new \Exception("Product not found: " . $productData['id']);
            }

            if($productData['quantity'] > 0) {
                $ordersProducts[] = new OrdersProducts(
                    OrderId::generate(),
                    $product,
                    $productData['quantity']
                );
            }

            $order->updateProducts($product, $productData['quantity']);
        }

        if($command->getDescription() !== null) {
            $order->setDescription(new OrderDescription($command->getDescription()));
        }

        $orderUpdated = $this->orderRepository->save($order);

        $orderDTO = null;
        if (count($order->getProducts()) > 0) {
            $orderDTO = new OrderDTO(
                $orderUpdated->getId(),
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
        } else {
            $this->orderRepository->delete(new OrderId($orderUpdated->getId()));
        }

        return $orderDTO;
    }
}