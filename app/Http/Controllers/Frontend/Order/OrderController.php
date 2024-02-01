<?php

namespace App\Http\Controllers\Frontend\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Domains\Order\Services\OrderService;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Domains\API\VNPay\Services\VNPayService;
use App\Domains\ProductDetail\Models\ProductDetail;
use App\Http\Requests\Frontend\Order\CheckoutRequest;
use App\Http\Requests\Frontend\Order\updateStatusRequest;
use App\Http\Requests\Frontend\Order\ProcessCheckoutRequest;
use App\Domains\API\VietNamProvince\Services\VietNamProvinceService;

class OrderController extends Controller
{
    protected OrderService $orderService;
    protected VietNamProvinceService $vietNamProvinceService;
    protected VNPayService $vnPayService;

    public function __construct(
        OrderService           $orderService,
        VietNamProvinceService $vietNamProvinceService,
        VNPayService           $vnPayService
    )
    {
        $this->orderService = $orderService;
        $this->vietNamProvinceService = $vietNamProvinceService;
        $this->vnPayService = $vnPayService;
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        if ($user->isAdmin() || $user->isRoleStaff()) {
            $orders = $this->orderService->search($request->all());
        } else if ($user->isRoleCustomer()) {
            $orders = $this->orderService->searchInEachUser($request->all());
        } else {
            $orders = new LengthAwarePaginator(collect([]), 0, config('constants.paginate'));
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

    public function updateStatusOrder(updateStatusRequest $request, int $orderId)
    {
        $order = $this->orderService->getById($orderId);

        $order->update([
            'status' => $request->get('orderStatus')
        ]);

        $order->touch();

        return response()->json([
            'status_code' => Response::HTTP_OK,
        ]);
    }

    public function getVNPayThanks()
    {
        if (session()->has('data')) {
            $this->processCheckoutWhenPayingInCash(session('data'));
            Session::forget(['data']);
        }

        return view('frontend.pages.orders.sub-page.thanks-vnpay');
    }

    public function getWaitPayment(Request $request)
    {
        return view('frontend.pages.orders.sub-page.wait-payment', ['data' => $request->all()]);
    }

    public function cancelOrder(int $orderId)
    {
        $order = $this->orderService->getById($orderId);

        if ($order->status == config('constants.status_order.cancel')) {
            return redirect()->route('frontend.orders.index')->withFlashDanger(__('This order has been canceled so it cannot be fulfilled.'));
        } elseif ($order->status == config('constants.status_order.delivered')) {
            return redirect()->route('frontend.orders.index')->withFlashDanger(__('The order has been successfully delivered, so it cannot be canceled.'));
        } else {
            if ($order->couponOrder != null) {
                $this->orderService->returnCouponInOrder($order->couponOrder);
            }

            if ($order->productOrder != null) {
                $this->orderService->returnProductInOrder($order->productOrder);
            }

            $order->update([
                'status' => config('constants.status_order.cancel')
            ]);

            $order->touch();

            return redirect()->route('frontend.orders.index')
                ->withFlashSuccess(__('The order has been successfully canceled.'));
        }
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

            return redirect(route('frontend.orders.getVNPayThanks'))->withFlashSuccess(__('Order Success.'))
                ->with('X-Clear-LocalStorage', 'true');
        } else if ($request->payment_method == config('constants.payment_method.vnpay')) {
            Session::put(['data' => $request->all()]);

            return view('frontend.pages.orders.sub-page.wait-payment', [
                'totalAllProduct' => $request->input('totalAllProduct'),
            ]);
        }
    }

    public function processCheckoutWhenPayingInCash($data = [])
    {
        $addressOrder = $this->orderService->createAddressOrder($data);

        $couponOrderId = null;

        if (isset($data['couponId'])) {
            $couponOrder = $this->orderService->createCouponOrder($data);
            $couponOrderId = $couponOrder->id;
        }

        $order = $this->orderService->createOrder($data, $addressOrder->id, $couponOrderId);

        $this->orderService->createProductOrder($data, $order->id);

        //Delete cart
        $this->orderService->deleteProductOrderSuccessInCart($data);

        if (isset($data['couponId'])) {
            $this->orderService->updateUseCouponWhenOrderSuccessfully($data['couponId'], $order->id);
            Session::forget(['coupon_id', 'coupon_name', 'coupon_type', 'coupon_value']);
        }
    }

    public function processCheckoutWhenPayingWithVnpay(Request $request)
    {
        return $this->vnPayService->getVNPayPayment($request->all());
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
                    'totalAllProduct' => (float)$request->totalCost + (float)$fee['total'],
                ]
            )->render()
        ]);
    }

    public function listOrderReturn(Request $request)
    {
        $user = auth()->user();
        if ($user->isAdmin() || $user->isRoleStaff()) {
            $orders = $this->orderService->searchReturn($request->all());
        } else if ($user->isRoleCustomer()) {
            $orders = $this->orderService->searchReturnInEachUser($request->all());
        } else {
            $orders = new LengthAwarePaginator(collect([]), 0, config('constants.paginate'));
        }

        return view('frontend.pages.orders.return-order.index', ['orders' => $orders]);
    }

    public function returnOrderInCustomer(int $orderId)
    {
        $order = $this->orderService->getById($orderId);

        $order->update([
            'is_return_order' => '1'
        ]);

        $order->touch();

        return response()->json([
            'status_code' => Response::HTTP_OK,
        ]);
    }

    public function returnOrderConfirmation(int $orderId)
    {
        $order = $this->orderService->getById($orderId);

        $order->update([
            'status_return_order' => '2'
        ]);

        $order->touch();

        return response()->json([
            'status_code' => Response::HTTP_OK,
        ]);
    }

    public function noReturnOrderConfirmation(int $orderId)
    {
        $order = $this->orderService->getById($orderId);

        $order->update([
            'is_return_order' => '2'
        ]);

        return response()->json([
            'status_code' => Response::HTTP_OK,
        ]);
    }

    public function updateStatusReturnOrder(Request $request, int $orderId)
    {
        $order = $this->orderService->getById($orderId);

        if ($request->get('orderReturnStatus') == config('constants.status_return_order.Refund successful')) {
            if ($order->couponOrder != null) {
                $this->orderService->returnCouponInOrder($order->couponOrder);
            }

            if ($order->productOrder != null) {
                $this->orderService->returnProductInOrder($order->productOrder);
            }

            $order->update([
                'status_return_order' => $request->get('orderReturnStatus')
            ]);

            $order->touch();

            return response()->json([
                'status_code' => Response::HTTP_OK,
            ]);
        }

        $order->update([
            'status_return_order' => $request->get('orderReturnStatus')
        ]);

        $order->touch();

        return response()->json([
            'status_code' => Response::HTTP_OK,
        ]);
    }
}
