<?php

namespace App\Domains\Cart\Services;

use App\Services\BaseService;
use Illuminate\Http\Response;
use App\Domains\Cart\Models\Cart;
use App\Domains\Coupon\Models\Coupon;
use App\Domains\CouponUser\Models\CouponUser;
use App\Domains\Product\Models\Product;
use App\Domains\ProductDetail\Models\ProductDetail;

/**
 * Class CartService.
 */
class CartService extends BaseService
{
    protected ProductDetail $productDetail;
    protected Product $product;
    protected Coupon $coupon;
    protected CouponUser $couponUser;
    /**
     * CartService constructor.
     * @param Cart $cart
     * @param ProductDetail $productDetail
     * @param Product $product
     * @param Coupon $coupon
     * @param CouponUser $couponUser
     */
    public function __construct(
        Cart $cart,
        ProductDetail $productDetail,
        Product $product,
        Coupon $coupon,
        CouponUser $couponUser
    ) {
        $this->model = $cart;
        $this->productDetail = $productDetail;
        $this->product = $product;
        $this->coupon = $coupon;
        $this->couponUser = $couponUser;
    }

    public function getProductInCartByUserId()
    {
        return $this->model
            ->where('user_id', auth()->user()->id)
            ->where('product_quantity', '!=', 0)
            ->get();
    }

    public function addToCart(array $data)
    {
        foreach ($data['productDetail'] as $item) {
            $productInCart = $this->getExistProductInCart($item['productDetailId']);
            if (isset($productInCart) && $productInCart->product_detail_id == $item['productDetailId']) {
                $productInCart->update([
                    'user_id' => auth()->user()->id,
                    'product_detail_id' => $item['productDetailId'],
                    'product_quantity' => $productInCart->product_quantity + (int) $item['quantity'],
                ]);
            } else {
                $this->model->create([
                    'user_id' => auth()->user()->id,
                    'product_detail_id' => $item['productDetailId'],
                    'product_quantity' => $item['quantity'],
                ]);
            }
            $productDetail = $this->getProductDetail($item['productDetailId']);
            $productDetail->update([
                'quantity' => $productDetail->quantity - (int) $item['quantity']
            ]);
        }
    }

    public function updateProductInCart(array $data)
    {
        $productDetailInCart = $this->getExistProductInCartByCartId($data['productDetailId'], $data['cartId']);

        abort_if(!$productDetailInCart, Response::HTTP_NOT_FOUND);
        $productDetail = $this->getProductDetail($data['productDetailId']);

        if ($data['newQuantity'] < 1) {
            $this->deleteProductFromCart($data['productDetailId'], $data['cartId']);
        } else if ($data['newQuantity'] > $data['oldQuantity']) { // Inc quantity
            $excessQuantity = $data['newQuantity'] - $data['oldQuantity'];
            $productDetailInCart->update([
                'product_quantity' => $data['newQuantity'],
            ]);

            $productDetail->update([
                'quantity' => $productDetail->quantity - (int) $excessQuantity
            ]);
        } else if ($data['newQuantity'] < $data['oldQuantity']) { //Dec quantity
            $excessQuantity = $data['oldQuantity'] - $data['newQuantity'];
            $productDetailInCart->update([
                'product_quantity' => $data['newQuantity'],
            ]);

            $productDetail->update([
                'quantity' => $productDetail->quantity + (int) $excessQuantity
            ]);
        }
    }

    public function deleteProductFromCart(int $productDetailId, int $cartId)
    {
        $productDetailInCart = $this->getExistProductInCartByCartId($productDetailId, $cartId);

        abort_if(!$productDetailInCart, Response::HTTP_NOT_FOUND);
        $productDetail = $this->getProductDetail($productDetailId);
        $productDetail->update([
            'quantity' => $productDetail->quantity + $productDetailInCart->product_quantity
        ]);

        $productDetailInCart->delete();
    }

    public function getExistProductInCart(int $productDetailId)
    {
        return $this->model
            ->where('user_id', auth()->user()->id)
            ->where('product_detail_id', $productDetailId)
            ->first();
    }

    public function getExistProductInCartByCartId(int $productDetailId, int $cartId)
    {
        return $this->model
            ->where('id', $cartId)
            ->where('user_id', auth()->user()->id)
            ->where('product_detail_id', $productDetailId)
            ->first();
    }

    public function getProductDetail(int $productDetailId)
    {
        return $this->productDetail
            ->where('id', $productDetailId)
            ->first();
    }

    public function getProductInCart(int $product)
    {
        return $this->product
            ->where('id', $product)
            ->first();
    }

    public function getProductDetailInCartByProductDetailId(int $productDetailId)
    {
        return $this->product
            ->where('user_id', auth()->user()->id)
            ->where('id', $productDetailId)
            ->first();
    }

    public function getSubPriceProductInCart()
    {
        $productsInCart = $this->getProductInCartByUserId();

        return $productsInCart->reduce(function ($carry, $cart) {
            $quantity = $cart->product_quantity;

            if (!$cart->productDetail->saleOption->isEmpty()) {
                if ($cart->productDetail->saleOption->first()->type == config('constants.type_sale.percent')) {
                    $cart->productDetail->salePrice = $cart->productDetail->price - $cart->productDetail->price * ($cart->productDetail->saleOption->first()->value / 100);
                    if ($cart->productDetail->salePrice < 0) {
                        $cart->productDetail->salePrice = 0;
                    }
                } else {
                    $cart->productDetail->salePrice =  $cart->productDetail->price - $cart->productDetail->saleOption->first()->value;
                    if ($cart->productDetail->salePrice < 0) {
                        $cart->productDetail->salePrice = 0;
                    }
                }
            } else if (!$cart->productDetail->product->saleGlobal->isEmpty()) {
                if ($cart->productDetail->product->saleGlobal->first()->type == config('constants.type_sale.percent')) {
                    $cart->productDetail->salePrice = $cart->productDetail->price - $cart->productDetail->price * ($cart->productDetail->product->saleGlobal->first()->value / 100);
                    if ($cart->productDetail->salePrice < 0) {
                        $cart->productDetail->salePrice = 0;
                    }
                } else {
                    $cart->productDetail->salePrice =  $cart->productDetail->price - $cart->productDetail->product->saleGlobal->first()->value;
                    if ($cart->productDetail->salePrice < 0) {
                        $cart->productDetail->salePrice = 0;
                    }
                }
            }

            return $carry + ($quantity * $cart->productDetail->salePrice);
        }, 0);
    }

    public function getPriceProductInCart()
    {
        $productsInCart = $this->getProductInCartByUserId();
        $subtotal = $productsInCart->reduce(function ($carry, $cart) {
            $quantity = $cart->product_quantity;

            if (!$cart->productDetail->saleOption->isEmpty()) {
                if ($cart->productDetail->saleOption->first()->type == config('constants.type_sale.percent')) {
                    $cart->productDetail->salePrice = $cart->productDetail->price - $cart->productDetail->price * ($cart->productDetail->saleOption->first()->value / 100);
                    if ($cart->productDetail->salePrice < 0) {
                        $cart->productDetail->salePrice = 0;
                    }
                } else {
                    $cart->productDetail->salePrice =  $cart->productDetail->price - $cart->productDetail->saleOption->first()->value;
                    if ($cart->productDetail->salePrice < 0) {
                        $cart->productDetail->salePrice = 0;
                    }
                }
            } else if (!$cart->productDetail->product->saleGlobal->isEmpty()) {
                if ($cart->productDetail->product->saleGlobal->first()->type == config('constants.type_sale.percent')) {
                    $cart->productDetail->salePrice = $cart->productDetail->price - $cart->productDetail->price * ($cart->productDetail->product->saleGlobal->first()->value / 100);
                    if ($cart->productDetail->salePrice < 0) {
                        $cart->productDetail->salePrice = 0;
                    }
                } else {
                    $cart->productDetail->salePrice =  $cart->productDetail->price - $cart->productDetail->product->saleGlobal->first()->value;
                    if ($cart->productDetail->salePrice < 0) {
                        $cart->productDetail->salePrice = 0;
                    }
                }
            }

            return $carry + ($quantity * $cart->productDetail->salePrice);
        }, 0);

        // Kiểm tra xem có session 'coupon' hay không
        if (session()->has('coupon_value') && session()->has('coupon_type')) {
            $couponType = session('coupon_type');
            if ($couponType == config('constants.coupon.percent')) {
                $PriceDecrease = $subtotal * (session('coupon_value') / 100);
                $subtotal = $subtotal - $PriceDecrease;
                if ($subtotal < 0) {
                    $subtotal = 0;
                }
            } else if ($couponType == config('constants.coupon.number')) {
                $subtotal =  $subtotal - session('coupon_value');
                if ($subtotal < 0) {
                    $subtotal = 0;
                }
            }
        }

        return $subtotal;
    }

    public function checkCouponUnusedUserAndStillExpiryDate(string|null $name)
    {
        return $this->coupon->firstWithExpiryDate($name ?? '');
    }

    public function checkCouponUserExist(int|string|null $id)
    {
        $this->couponUser->where('user_id', auth()->user()->id)
            ->where('coupon_id', $id)
            ->where('is_used', config('constants.is_used.false'))
            ->first();
    }

    public function getCouponByName(string|null $name)
    {
        return $this->coupon->where('name', $name ?? '')->first();
    }

    public function getCountQuantityProductInCart()
    {
        return $this->model->where('user_id', auth()->user()->id)->count();
    }

    public function applyCouponIntoCart(string $name)
    {
        $coupon = $this->coupon->firstWithExpiryDate($name);

        $coupon->update([
            'quantity' => (int) $coupon->quantity - 1
        ]);

        $coupon->syncUser(auth()->user()->id);

        return $coupon;
    }

    public function deleteCouponFromCart($name)
    {
        $coupon = $this->getCouponByName($name);

        $coupon->update([
            'quantity' => (int) $coupon->quantity + 1
        ]);

        $coupon->detachUser(auth()->user()->id);

        return $coupon;
    }

    public function getDiscount($carts)
    {
        foreach ($carts as $cart) {
            if (!$cart->productDetail->saleOption->isEmpty()) {
                if ($cart->productDetail->saleOption->first()->type == config('constants.type_sale.percent')) {
                    $cart->productDetail->salePrice = $cart->productDetail->price - $cart->productDetail->price * ($cart->productDetail->saleOption->first()->value / 100);
                    if ($cart->productDetail->salePrice < 0) {
                        $cart->productDetail->salePrice = 0;
                    }
                } else {
                    $cart->productDetail->salePrice =  $cart->productDetail->price - $cart->productDetail->saleOption->first()->value;
                    if ($cart->productDetail->salePrice < 0) {
                        $cart->productDetail->salePrice = 0;
                    }
                }

                $cart->productDetail->reducedValue = $cart->productDetail->saleOption->first()->value;
                $cart->productDetail->reducedType = $cart->productDetail->saleOption->first()->type;
            } else if (!$cart->productDetail->product->saleGlobal->isEmpty()) {
                if ($cart->productDetail->product->saleGlobal->first()->type == config('constants.type_sale.percent')) {
                    $cart->productDetail->salePriceGlobal = $cart->productDetail->price - $cart->productDetail->price * ($cart->productDetail->product->saleGlobal->first()->value / 100);
                    if ($cart->productDetail->salePriceGlobal < 0) {
                        $cart->productDetail->salePriceGlobal = 0;
                    }
                } else {
                    $cart->productDetail->salePriceGlobal =  $cart->productDetail->price - $cart->productDetail->product->saleGlobal->first()->value;
                    if ($cart->productDetail->salePriceGlobal < 0) {
                        $cart->productDetail->salePriceGlobal = 0;
                    }
                }
                $cart->productDetail->reducedValue = $cart->productDetail->product->saleGlobal->first()->value;
                $cart->productDetail->reducedType = $cart->productDetail->product->saleGlobal->first()->type;
            }
        }

        return $carts;
    }
}
