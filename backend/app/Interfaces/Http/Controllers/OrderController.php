<?php 

namespace App\Interfaces\Http\Controllers;

use App\Application\Orders\Command\CreateOrderCommand;
use App\Application\Orders\Handler\CreateOrderHandler;
use App\Interfaces\Http\Requests\Orders\CreateOrderRequest;
use App\Application\Orders\Handler\GetAllOrdersHandler;
use App\Application\Orders\Query\GetAllOrdersQuery;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $createOrderHandler;
    private $getAllOrdersHandler;

    public function __construct(
        CreateOrderHandler $createOrderHandler,
        GetAllOrdersHandler $getAllOrdersHandler
        )
    {
        $this->createOrderHandler = $createOrderHandler;
        $this->getAllOrdersHandler = $getAllOrdersHandler;
    }

    public function index(Request $request)
    {
        try {
            $query = new GetAllOrdersQuery();
            $orders = $this->getAllOrdersHandler->handle($query);

            return response()->json(['data' => [
                'count' => count($orders),
                'orders' => $orders
            ]]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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