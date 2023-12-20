<?php

namespace App\Http\Controllers\Frontend\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Domains\Order\Services\OrderService;
use App\Domains\ProductDetail\Models\ProductDetail;
use App\Http\Requests\Frontend\Order\CheckoutRequest;
use App\Http\Requests\Frontend\Order\ProcessCheckoutRequest;
use App\Domains\API\VietNamProvince\Services\VietNamProvinceService;

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

    public function index(Request $request)
    {
        $user = auth()->user();
        if ($user->isAdmin() || $user->isRoleStaff()) {
            $orders = $this->orderService->search($request->all());
        } else if ($user->isRoleCustomer()) {
            $orders = $this->orderService->searchInEachUser($request->all());
        } else {
            $orders = collect([])->paginate(config('constants.paginate'));
        }

        return view('frontend.pages.orders.index', ['orders' => $orders]);
    }

    public function getCustomerInformation(int $orderId)
    {
        $order = $this->orderService->getById($orderId);

        return view('frontend.pages.orders.customer-information', ['order' => $order]);
    }

    public function getProductInformation(int $orderId)
    {
        $order = $this->orderService->getById($orderId);
        return view('frontend.pages.orders.product-information', ['order' => $order]);
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
                'couponId' => $request->couponId
            ];

            $data = array_merge($data, $dataCoupon);
        }

        return view('frontend.pages.orders.checkout', $data);
    }

    public function processCheckout(ProcessCheckoutRequest $request)
    {
        if ($request->payment_method == config('constants.payment_method.direct')) {
            $this->processCheckoutWhenPayingInCash($request->all());

            return redirect(route('frontend.user.dashboard'))->withFlashSuccess(__('Order Success.'))
            ->with('X-Clear-LocalStorage', 'true');
        }
    }

    public function processCheckoutWhenPayingInCash($data = [])
    {
        $addressOrder = $this->orderService->createAddressOrder($data);

        $order = $this->orderService->createOrder($data, $addressOrder->id);

        $this->orderService->createProductOrder($data, $order->id);

        $this->orderService->deleteProductOrderSuccessInCart($data);

        if (isset($data['couponId'])) {
            $this->orderService->updateUseCouponWhenOrderSuccessfully($data['couponId'], $order->id);
            Session::forget(['coupon_id', 'coupon_name', 'coupon_type', 'coupon_value']);
        }
    }

    public function processCheckoutWhenPayingWithVnpay($data = [])
    {
    }

    public function processCheckoutWhenPayingWithMomo($data = [])
    {
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
