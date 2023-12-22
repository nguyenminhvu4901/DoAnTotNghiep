<?php

namespace App\Domains\Order\Services;

use Exception;
use Illuminate\Support\Str;
use App\Services\BaseService;
use App\Domains\Cart\Models\Cart;
use Illuminate\Support\Facades\DB;
use App\Domains\Order\Models\Order;
use App\Exceptions\GeneralException;
use App\Domains\Coupon\Models\Coupon;
use App\Domains\CouponUser\Models\CouponUser;
use App\Domains\AddressOrder\Models\AddressOrder;
use App\Domains\ProductOrder\Models\ProductOrder;

/**
 * Class CategoryService.
 */
class OrderService extends BaseService
{
    protected AddressOrder $addressOrder;
    protected ProductOrder $productOrder;
    protected Coupon $coupon;
    protected CouponUser $couponUser;
    protected Cart $cart;
    /**
     * OrderService constructor.
     */
    public function __construct(
        Order $order,
        AddressOrder $addressOrder,
        ProductOrder $productOrder,
        Coupon $coupon,
        CouponUser $couponUser,
        Cart $cart
    ) {
        $this->model = $order;
        $this->addressOrder = $addressOrder;
        $this->productOrder = $productOrder;
        $this->coupon = $coupon;
        $this->couponUser = $couponUser;
        $this->cart = $cart;
    }

    public function search($data = [])
    {
        return $this->model
            ->latest('id')
            ->paginate(config('constants.paginate'));
    }

    public function searchInEachUser($data = [])
    {
        return $this->model
            ->where('user_id', auth()->user()->id)
            ->latest('id')
            ->paginate(config('constants.paginate'));
    }

    public function createAddressOrder($data)
    {
        DB::beginTransaction();
        try {
            $addressOrder = $this->addressOrder->create([
                'province' => $data['province_name'],
                'district' => $data['district_name'],
                'ward' => $data['ward_name'],
                'address' => $data['customer_address'],
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating address order. Please try again.'));
        }

        return $addressOrder;
    }

    public function createOrder($data = [], $addressId)
    {
        DB::beginTransaction();
        try {
            $order = $this->model->create([
                'code_order' => Str::random(10),
                'user_id' => auth()->user()->id,
                'status' => config('constants.status_order.ready_to_pick'),
                'payment_method' => $data['payment_method'],
                'sub_total' => $data['subTotalAllProduct'],
                'total' => $data['totalAllProduct'],
                'address_order_id' => $addressId,
                'ship' => $data['ship'],
                'customer_name' => $data['customer_name'],
                'customer_email' => $data['customer_email'],
                'customer_phone' => $data['customer_phone'],
                'note' => $data['note'] ?? '',
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating address order. Please try again.'));
        }

        return $order;
    }

    public function createProductOrder($data = [], $orderId)
    {
        foreach ($data['productDetail'] as $product) {
            $this->productOrder->create([
                'user_id' => auth()->user()->id,
                'product_id' => $product['productId'],
                'order_id' => $orderId,
                'product_quantity' => $product['quantity'],
                'product_size' => $product['size'],
                'product_color' => $product['color'],
                'product_price' => $product['price'],
            ]);
        }
    }

    public function deleteProductOrderSuccessInCart($data = [])
    {
        foreach ($data['productDetail'] as $product) {
            $this->cart->where('product_detail_id', $product['productDetailId'])
                ->where('user_id', auth()->user()->id)
                ->delete();
        }
    }

    public function updateUseCouponWhenOrderSuccessfully($couponId, $orderId)
    {
        $couponUser = $this->couponUser
            ->where('coupon_id', $couponId)
            ->where('user_id', auth()->user()->id)
            ->first();
            
        if (isset($couponUser)) {
            $couponUser->update([
                'is_used' => config('constants.is_used.true'),
                'order_id' => $orderId
            ]);
        }

        return $couponUser;
    }
}
