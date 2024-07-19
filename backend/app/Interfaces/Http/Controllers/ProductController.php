<?php

namespace App\Interfaces\Http\Controllers;

use App\Application\Products\Handler\CreateProductHandler;
use App\Application\Products\Handler\GetAllProductsHandler;
use App\Application\Products\Handler\GetProductHandler;
use App\Application\Products\Handler\DeleteProductHandler;
use App\Application\Products\Query\GetAllProductsQuery;
use App\Application\Products\Query\GetProductQuery;
use App\Application\Products\Command\CreateProductCommand;
use App\Application\Products\Command\DeleteProductCommand;
use App\Application\Products\DTO\ProductDTO;
use App\Domain\Products\ValueObjects\ProductId;
use App\Interfaces\Http\Requests\Products\CreateProductRequest;
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

            return response()->json(['data' => [
                'count' => count($productDTOs),
                'products' => $productDTOs
            ]]);
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
