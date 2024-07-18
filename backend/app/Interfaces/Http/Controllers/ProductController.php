<?php

namespace App\Interfaces\Http\Controllers;

use App\Application\Handler\CreateProductHandler;
use App\Application\Handler\GetAllProductsHandler;
use App\Application\Handler\GetProductHandler;
use App\Application\Handler\DeleteProductHandler;
use App\Application\Query\GetAllProductsQuery;
use App\Application\Query\GetProductQuery;
use App\Application\Command\CreateProductCommand;
use App\Application\Command\DeleteProductCommand;
use App\Application\DTO\ProductDTO;
use App\Domain\Products\ValueObjects\ProductId;
use App\Interfaces\Http\Requests\CreateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $createProductHandler;
    private $getAllProductsHandler;
    private $getProductHandler;
    private $deleteProductHandler;

    public function __construct(
        CreateProductHandler $createProductHandler, 
        GetAllProductsHandler $getAllProductsHandler,
        GetProductHandler $getProductHandler,
        DeleteProductHandler $deleteProductHandler
        )
    {
        $this->createProductHandler = $createProductHandler;
        $this->getAllProductsHandler = $getAllProductsHandler;
        $this->getProductHandler = $getProductHandler;
        $this->deleteProductHandler = $deleteProductHandler;
    }

    public function index(Request $request)
    {
        try {
            $query = new GetAllProductsQuery();
            $productDTOs = $this->getAllProductsHandler->handle($query);

            return response()->json(['products' => $productDTOs]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $query = new GetProductQuery(new ProductId($id));
            $productDTO = $this->getProductHandler->handle($query);

            return response()->json($productDTO);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function store(CreateProductRequest $request)
    {
        $command = new CreateProductCommand(
            $request->input('name'),
            $request->input('price'),
        );
        $this->createProductHandler->handle($command);
        return response()->json(['message' => 'Product created successfully.']);
    }

    public function destroy(string $id)
    {
        try {
            $command = new DeleteProductCommand(new ProductId($id));
            $this->deleteProductHandler->handle($command);

            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

}
