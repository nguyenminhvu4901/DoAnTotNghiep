<?php

namespace App\Http\Controllers\Frontend\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Domains\Order\Services\OrderService;
use App\Domains\ProductDetail\Models\ProductDetail;
use App\Http\Requests\Frontend\Order\CheckoutRequest;
use App\Domains\API\VietNamProvince\Services\VietNamProvinceService;
use App\Http\Requests\Frontend\Order\ProcessCheckoutRequest;

class OrderController extends Controller
{
    protected OrderService $orderService;
    protected VietNamProvinceService $vietNamProvinceService;

    public function __construct(
        OrderService $orderService,
        VietNamProvinceService $vietNamProvinceService
    ) {
        $this->orderService = $orderService;
        $this->vietNamProvinceService = $vietNamProvinceService;
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

        $provinces = $this->getProvinceInVietNam();

        $data = [
            'productDetails' => $productDetails,
            'subAllProduct' => $request->subAllProduct,
            'totalAllProduct' => $request->totalAllProduct,
            'provinces' => $provinces,
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

    public function processCheckout(ProcessCheckoutRequest $request)
    {
        dd($request->all());
    }

    public function getDistrictDetailByProvinceId(Request $request, $provinceID)
    {
        
        $districts = $this->vietNamProvinceService->getDistrictByProvinceId($request->provinceId);

        return response()->json([
            'status_code' => Response::HTTP_OK,
            'data' => view(
                'frontend.pages.orders.partials.district-detail',
                [
                    'districts' => $districts,
                    'totalAllProduct' => $request->totalCost,
                    'oldDistrict' => $request->district
                ]
            )->render()
        ]);
    }

    public function getProvinceInVietNam()
    {
        return $this->vietNamProvinceService->getProvinces();
    }

    public function getWardDetailByDistrictId(Request $request)
    {
        $wards = $this->vietNamProvinceService->getWardByDistrictId($request->districtId);

        return response()->json([
            'status_code' => Response::HTTP_OK,
            'data' => view(
                'frontend.pages.orders.partials.ward-detail',
                [
                    'wards' => $wards,
                    'districtId' => $request->districtId,
                    'totalAllProduct' => $request->totalCost,
                    'oldWard' => $request->ward
                ]
            )->render()
        ]);
    }

    public function getShippingCostDetail(Request $request, $districtId)
    {
        $fee = $this->vietNamProvinceService->getShippingCost($districtId, $request->wardCode);

        return response()->json([
            'status_code' => Response::HTTP_OK,
            'data' => view(
                'frontend.pages.orders.partials.fee-detail',
                [
                    'ship' => $fee['total'],
                    'totalAllProduct' => (float) $request->totalCost + (float) $fee['total'],
                ]
            )->render()
        ]);
    }
}
