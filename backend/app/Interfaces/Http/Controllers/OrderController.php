<?php 

namespace App\Interfaces\Http\Controllers;

use App\Application\Orders\Command\CreateOrderCommand;
use App\Application\Orders\Handler\CreateOrderHandler;
use App\Interfaces\Http\Requests\Orders\CreateOrderRequest;

class OrderController extends Controller
{
    private $createOrderHandler;

    public function __construct(CreateOrderHandler $createOrderHandler)
    {
        $this->createOrderHandler = $createOrderHandler;
    }

    public function store(CreateOrderRequest $request)
    {
        try {
            $command = new CreateOrderCommand(
                $request->input('customer_id'),
                $request->input('description'),
                $request->input('products')
            );
            $orderDTO = $this->createOrderHandler->handle($command);

            return response()->json(['message' => 'Order created', 'order' => $orderDTO]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}