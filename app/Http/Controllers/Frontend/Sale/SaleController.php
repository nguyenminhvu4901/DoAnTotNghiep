<?php

namespace App\Http\Controllers\Frontend\Sale;

use App\Domains\Sale\Services\SaleService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    protected SaleService $saleService;
    public function __construct(
        SaleService $saleService
    ) {
        $this->saleService = $saleService;
    }

    public function index(Request $request)
    {

    }

    public function create(Request $request, int $productId)
    {
        if($request->level == 'parent')
        {
            $product = $this->saleService->getProductById($productId);
        }else if($request->level == 'child') {

        }

        return view('frontend.pages.sales.create', ['product' => $product]);
    }

    public function store(Request $request)
    {

    }
}
