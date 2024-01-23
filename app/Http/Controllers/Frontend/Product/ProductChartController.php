<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Domains\ProductOrder\Services\ProductOrderService;
use App\Http\Controllers\Controller;
use App\Domains\Product\Services\ProductService;
use Illuminate\Http\Request;
use Livewire\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ProductChartController extends Controller
{
    public function __construct(
        protected ProductService $productService,
        protected ProductOrderService $productOrderService
    ) {
    }

    public function index(Request $request)
    {
        $bestSellers = $this->productService->getBestSellers();
        $bestSellerBarChartData = $this->productService->convertBestSellersToBarChartData($bestSellers);
        return view('frontend.pages.product-chart.index', [
            'bestSellers' => $bestSellers,
            'bestSellerBarChartData' => $bestSellerBarChartData
        ]);
    }

    public function show(Request $request): \Illuminate\Http\JsonResponse
    {
//        abort_if(!$request->ajax(), \Illuminate\Http\Response::HTTP_NOT_FOUND);
        $productId = $request->get('id');
        $product = $this->productService->getById($productId);
        $product->load(['productDetail']);
        
        return response()->json([
            'html' => view('frontend.pages.product-chart.detail', [
                'product' => $product
            ])->render()
        ], ResponseAlias::HTTP_OK);
    }
}
