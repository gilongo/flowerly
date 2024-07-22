<?php 

namespace App\Interfaces\Http\Controllers;

use App\Application\Orders\Command\CreateOrderCommand;
use App\Application\Orders\Command\UpdateOrderCommand;
use App\Application\Orders\Command\DeleteOrderCommand;
use App\Application\Orders\Handler\CreateOrderHandler;
use App\Interfaces\Http\Requests\Orders\CreateOrderRequest;
use App\Interfaces\Http\Requests\Orders\UpdateOrderRequest;
use App\Application\Orders\Handler\GetAllOrdersHandler;
use App\Application\Orders\Query\GetAllOrdersQuery;
use App\Application\Orders\Handler\GetOrderHandler;
use App\Application\Orders\Handler\UpdateOrderHandler;
use App\Application\Orders\Handler\DeleteOrderHandler;
use App\Application\Orders\Query\GetOrderQuery;
use App\Domain\Orders\ValueObjects\OrderId;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $createOrderHandler;
    private $getAllOrdersHandler;
    private $updateOrderHandler;
    private $getOrderHandler;
    private $deleteOrderHandler;

    public function __construct(
        CreateOrderHandler $createOrderHandler,
        GetAllOrdersHandler $getAllOrdersHandler,
        GetOrderHandler $getOrderHandler,
        UpdateOrderHandler $updateOrderHandler,
        DeleteOrderHandler $deleteOrderHandler
        )
    {
        $this->createOrderHandler = $createOrderHandler;
        $this->getAllOrdersHandler = $getAllOrdersHandler;
        $this->getOrderHandler = $getOrderHandler;
        $this->updateOrderHandler = $updateOrderHandler;
        $this->deleteOrderHandler = $deleteOrderHandler;
    }

    public function index(Request $request)
    {
        try {
            $description = $request->query('description');
            $product_name = $request->query('product_name');
            $date_from = urldecode($request->query('date_from'));
            $date_to = urldecode($request->query('date_to'));

            $query = new GetAllOrdersQuery($description, $product_name, $date_from, $date_to);
            $orders = $this->getAllOrdersHandler->handle($query);

            return response()->json(['data' => [
                'count' => count($orders),
                'orders' => $orders
            ]]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $query = new GetOrderQuery(new OrderId($id));
            $orderDTO = $this->getOrderHandler->handle($query);

            return response()->json($orderDTO);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
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

    public function update(UpdateOrderRequest $request, string $id)
    {
        try {
            $command = new UpdateOrderCommand(
                $id,
                $request->input('description') ?? null,
                $request->input('products') ?? []
            );
            $orderDTO = $this->updateOrderHandler->handle($command);

            if ($orderDTO === null) {
                return response()->json(null, 204);
            }

            return response()->json($orderDTO);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function destroy(string $id)
    {
        try {
            $command = new DeleteOrderCommand(new OrderId($id));
            $this->deleteOrderHandler->handle($command);

            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}