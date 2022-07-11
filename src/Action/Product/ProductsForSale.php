<?php

namespace App\Action\Product;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ProductsForSale
{
    private ProductRepository $productRepository;

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {

        $this->productRepository = $productRepository;
    }

    public function __invoke(Request $request): JsonResponse
    {

        return new JsonResponse($this->productRepository->getProductsForSales());
    }
}