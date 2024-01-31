<?php

namespace App\Domains\Order\Services;

use App\Domains\CouponOrder\Models\CouponOrder;
use App\Domains\ProductDetail\Models\ProductDetail;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
    protected CouponOrder $couponOrder;
    protected ProductDetail $productDetail;

    /**
     * OrderService constructor.
     */
    public function __construct(
        Order         $order,
        AddressOrder  $addressOrder,
        ProductOrder  $productOrder,
        Coupon        $coupon,
        CouponUser    $couponUser,
        Cart          $cart,
        CouponOrder   $couponOrder,
        ProductDetail $productDetail
    )
    {
        $this->model = $order;
        $this->addressOrder = $addressOrder;
        $this->productOrder = $productOrder;
        $this->coupon = $coupon;
        $this->couponUser = $couponUser;
        $this->cart = $cart;
        $this->couponOrder = $couponOrder;
        $this->productDetail = $productDetail;
    }

    public function search($data = [])
    {
        return $this->model
            ->search($this->escapeSpecialCharacter($data['search'] ?? ''))
            ->when(isset($data['payment_method']), function ($query) use ($data) {
                $query->filterByPaymentMethod($data['payment_method']);
            })->when(isset($data['status']), function ($query) use ($data) {
                $query->filterByStatus($data['status']);
            })
            ->latest('id')
            ->paginate(config('constants.paginate'));
    }

    public function searchInEachUser($data = [])
    {
        return $this->model
            ->search($this->escapeSpecialCharacter($data['search'] ?? ''))
            ->where('user_id', auth()->user()->id)
            ->latest('id')
            ->paginate(config('constants.paginate'));
    }

    public function searchReturn($data = [])
    {
        return $this->model
            ->where('status', config('constants.status_order.delivered'))
            ->search($this->escapeSpecialCharacter($data['search'] ?? ''))
            ->when(isset($data['payment_method']), function ($query) use ($data) {
                $query->filterByPaymentMethod($data['payment_method']);
            })->when(isset($data['status']), function ($query) use ($data) {
                $query->filterByStatus($data['status']);
            })
            ->latest('id')
            ->paginate(config('constants.paginate'));
    }

    public function searchReturnInEachUser($data = [])
    {
        return $this->model
            ->where('status', config('constants.status_order.delivered'))
            ->search($this->escapeSpecialCharacter($data['search'] ?? ''))
            ->where('user_id', auth()->user()->id)
            ->latest('id')
            ->whereDate('updated_at', '>=', now()->subDays(7)->toDateString())
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

    public function createOrder($data = [], $addressId, $couponId)
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
                'coupon_order_id' => isset($couponId) ? $couponId : null
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating order. Please try again.'));
        }

        return $order;
    }

    public function createProductOrder($data = [], $orderId)
    {
        DB::beginTransaction();
        try {
            foreach ($data['productDetail'] as $product) {
                $productOrder = $this->productOrder->create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $product['productId'],
                    'product_detail_id' => $product['productDetailId'],
                    'order_id' => $orderId,
                    'product_name' => $product['name'],
                    'product_quantity' => $product['quantity'],
                    'product_size' => $product['size'],
                    'product_color' => $product['color'],
                    'product_price' => $product['price'],
                ]);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating order. Please try again.'));
        }

        return $productOrder;
    }

    public function deleteProductOrderSuccessInCart($data = [])
    {
        DB::beginTransaction();
        try {
            foreach ($data['productDetail'] as $product) {
                $this->cart->where('product_detail_id', $product['productDetailId'])
                    ->where('user_id', auth()->user()->id)
                    ->delete();
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem deleting order. Please try again.'));
        }
    }

    public function updateUseCouponWhenOrderSuccessfully($couponId, $orderId)
    {
        DB::beginTransaction();
        try {
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
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating order. Please try again.'));
        }

        return $couponUser;
    }

    public function createCouponOrder($data)
    {
        DB::beginTransaction();
        try {
            $couponOrder = $this->couponOrder->create([
                'name' => $data['couponName'],
                'type' => $data['couponType'],
                'value' => $data['couponValue'],
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating coupon order. Please try again.'));
        }

        return $couponOrder;
    }

    public function returnProductInOrder($products)
    {
        DB::beginTransaction();
        foreach ($products as $product) {
            try {
                $productDetail = $this->productDetail->findOrFail($product->product_detail_id);
                $productDetail->update([
                    'quantity' => $productDetail->quantity + $product->product_quantity
                ]);
                DB::commit();
            } catch (ModelNotFoundException $e) {
                DB::rollBack();
                throw new GeneralException(__('Product detail not found.'));
            } catch (Exception $e) {
                DB::rollBack();
                throw new GeneralException(__('There was a problem updating the product detail. Please try again.'));
            }
        }
    }

    public function returnCouponInOrder($coupons)
    {
        DB::beginTransaction();
        try {
            $productCoupon = $this->coupon->where('name', $coupons->name)->first();

            if ($productCoupon) {
                $productCoupon->update([
                    'quantity' => (int)$productCoupon->quantity + 1
                ]);

                $this->couponUser->where('coupon_id', $productCoupon->id)->delete();
            } else {
                throw new GeneralException(__('Coupon not found.'));
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new GeneralException(__('There was a problem creating coupon order. Please try again.'));
        }
    }
}
