<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Product\ProductRequest;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Resources\ProductResource;
use App\Interfaces\ProductServiceInterface;

class ProductController
{

    protected $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function index(ProductRequest $request)
    {
        $products = $this->productService->getAll($request);

        return ProductResource::collection($products);
    }

    public function store(StoreRequest $request)
    {
        try {
            return new ProductResource($this->productService->create($request));
        } catch (\Exception $exception) {
            abort(500,  'Product could not be created');
        }
    }


}
