<?php 

namespace App\Interfaces\Http\Controllers;

use App\Application\Customers\Handler\CreateCustomerHandler;
use App\Application\Customers\Handler\GetAllCustomersHandler;
use App\Application\Customers\Query\GetAllCustomersQuery;
use App\Application\Customers\Command\CreateCustomerCommand;
use App\Application\Customers\DTO\CustomerDTO;
use App\Interfaces\Http\Requests\Customers\CreateCustomerRequest;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $createCustomerHandler;
    private $getAllCustomersHandler;

    public function __construct(
        CreateCustomerHandler $createCustomerHandler,
        GetAllCustomersHandler $getAllCustomersHandler
        )
    {
        $this->createCustomerHandler = $createCustomerHandler;
        $this->getAllCustomersHandler = $getAllCustomersHandler;
    }

    public function index(Request $request)
    {
        try {
            $query = new GetAllCustomersQuery();
            $customersDTOs = $this->getAllCustomersHandler->handle($query);

            return response()->json(['data' => [
                'count' => count($customersDTOs),
                'customers' => $customersDTOs
            ]]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(CreateCustomerRequest $request)
    {
        $command = new CreateCustomerCommand(
            $request->input('firstName'),
            $request->input('lastName'),
            $request->input('address'),
            $request->input('email'),
            $request->input('phone')
        );
        $this->createCustomerHandler->handle($command);
        return response()->json(['message' => 'Customer created successfully.']);
    }
    
}