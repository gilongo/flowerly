<?php 

namespace App\Interfaces\Http\Controllers;

use App\Application\Customers\Handler\CreateCustomerHandler;
use App\Application\Customers\Command\CreateCustomerCommand;
use App\Interfaces\Http\Requests\Customers\CreateCustomerRequest;

class CustomerController extends Controller
{
    private $createCustomerHandler;

    public function __construct(CreateCustomerHandler $createCustomerHandler)
    {
        $this->createCustomerHandler = $createCustomerHandler;
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