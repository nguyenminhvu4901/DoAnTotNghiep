<?php

namespace App\Http\Controllers\Frontend\Cart;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Domains\Coupon\Models\Coupon;
use Illuminate\Support\Facades\Session;
use App\Domains\Cart\Services\CartService;
use App\Http\Requests\Frontend\Cart\AddToCartRequest;
use App\Http\Requests\Frontend\Cart\ApplyCouponRequest;

class CartController extends Controller
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(Request $request)
    {
        $carts = $this->cartService->getProductInCartByUserId();
        $priceAllProductInCart = $this->cartService->getPriceProductInCart();
        $subPriceProductInCart = $this->cartService->getSubPriceProductInCart();

        $carts =  $this->cartService->getDiscount($carts);

        $data = [
            'carts' => $carts,
            'priceAllProductInCart' => $priceAllProductInCart,
            'subPriceAllProductInCart' => $subPriceProductInCart
        ];

        return view('frontend.pages.carts.index', $data);
    }

    public function addToCart(AddToCartRequest $request)
    {
        $data = $request->all();
        $this->cartService->addToCart($request->all());

        return redirect(route('frontend.products.detail', ['id' => $data['productId']]))->withFlashSuccess(__('Successfully add to cart.'));
    }

    public function updateProductInCart(Request $request, int $productDetailId, int $cartId)
    {
        abort_if(!$request->ajax(), Response::HTTP_NOT_FOUND);
        $this->cartService->updateProductInCart($request->all());

        $carts = $this->cartService->getProductInCartByUserId();
        $priceAllProductInCart = $this->cartService->getPriceProductInCart();

        return $this->getViewCartIndex($carts, $priceAllProductInCart);
    }

    public function deleteProductFromCart(Request $request, int $productDetailId, int $cartId)
    {
        abort_if(!$request->ajax(), Response::HTTP_NOT_FOUND);
        $this->cartService->deleteProductFromCart($productDetailId, $cartId);
        $carts = $this->cartService->getProductInCartByUserId();
        $priceAllProductInCart = $this->cartService->getPriceProductInCart();

        return $this->getViewCartIndex($carts, $priceAllProductInCart);
    }

    public function getViewCartIndex($carts, $maxPrice)
    {
        return response()->json([
            'status_code' => Response::HTTP_OK,
        ]);
    }

    public function applyCoupon(ApplyCouponRequest $request)
    {
        if (isset($request->coupon_code) && $request->old_coupon_name == null) {

            $coupon = $this->cartService->checkCouponUnusedUserAndStillExpiryDate($request->coupon_code);

            if ($coupon instanceof Coupon) {
                $couponApply = $this->cartService->applyCouponIntoCart($request->coupon_code);
                Session::put('coupon_id', $couponApply->id);
                Session::put('coupon_name', $couponApply->name);
                Session::put('coupon_type', $couponApply->type);
                Session::put('coupon_value', $couponApply->value);

                return redirect()->route('frontend.carts.index')
                    ->withFlashSuccess(__('Apply discount code successfully.'));
            } else {
                Session::forget(['coupon_id', 'coupon_name', 'coupon_type', 'coupon_value']);
                return redirect()->route('frontend.carts.index')->withFlashDanger(__('The discount code does not exist or has expired.'));
            }
        } //Click x to delete coupon from cart 
        else if (isset($request->old_coupon_name) && $request->coupon_code == null && isset($request->checkDelete) && $request->checkDelete) {
            $coupon = $this->cartService->getCouponByName($request->old_coupon_name);

            if ($coupon instanceof Coupon) {
                $this->cartService->deleteCouponFromCart($request->old_coupon_name);
                Session::forget(['coupon_id', 'coupon_name', 'coupon_type', 'coupon_value']);

                return redirect()->route('frontend.carts.index')
                    ->withFlashSuccess(__('Successfully deleted coupon code.'));
            }
        } // Apply new coupon and delete old coupon from cart 
        else if (isset($request->old_coupon_name) && isset($request->coupon_code) && $request->coupon_code != $request->old_coupon_name) {
            $couponToApply = $this->cartService->checkCouponUnusedUserAndStillExpiryDate($request->coupon_code);

            if ($couponToApply instanceof Coupon) {
                Session::forget(['coupon_id', 'coupon_name', 'coupon_type', 'coupon_value']);

                $couponApply = $this->cartService->applyCouponIntoCart($request->coupon_code);

                Session::put('coupon_id', $couponApply->id);
                Session::put('coupon_name', $couponApply->name);
                Session::put('coupon_type', $couponApply->type);
                Session::put('coupon_value', $couponApply->value);

                $this->cartService->deleteCouponFromCart($request->old_coupon_name);

                return redirect()->route('frontend.carts.index')
                    ->withFlashSuccess(__('Apply discount code successfully.'));
            } else {
                return redirect()->route('frontend.carts.index')->withFlashDanger(__('The discount code does not exist or has expired.'));
            }
        } // Reapply existing coupon
        else if (isset($request->old_coupon_name) && isset($request->coupon_code) && $request->coupon_code == $request->old_coupon_name) {
            return redirect()->route('frontend.carts.index')->withFlashWarning(__('The coupon is being used.'));
        } else {
            return redirect()->route('frontend.carts.index');
        }
    }
}
