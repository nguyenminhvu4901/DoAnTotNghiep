<?php

namespace App\Http\Controllers\Frontend\Order;

use App\Http\Controllers\Controller;
use App\Domains\Order\Services\OrderService;
use App\Domains\ProductDetail\Models\ProductDetail;
use App\Http\Requests\Frontend\Order\CheckoutRequest;

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function checkout(CheckoutRequest $request)
    {
        $productDetails = collect($request->productDetail)->map(function ($item) {
            $data = new ProductDetail($item);
            $data->productDetailId = $item['productDetailId'];
            $data->productId = $item['productId'];
            $data->nameProduct = $item['name'];
            return $data;
        });
       
        $data = [
            'productDetails' => $productDetails,
            'subAllProduct' => $request->subAllProduct,
            'totalAllProduct' => $request->totalAllProduct,
        ];

        if (isset($request->couponValue) && isset($request->couponName) && isset($request->couponType)) {
            $dataCoupon = [
                'couponValue' => $request->couponValue,
                'couponName' => $request->couponName,
                'couponType' => $request->couponType,
            ];

            $data = array_merge($data, $dataCoupon);
        }

        return view('frontend.pages.orders.checkout', $data);
    }
}
