<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Sale</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($carts as $key => $cart)
                                <tr>
                                    <td class="shoping__cart__item">
                                        <h5>{{ optional($cart->product())->first()->name }}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        {{ $cart->product_color }}
                                    </td>
                                    <td class="shoping__cart__price">
                                        {{ $cart->product_size }}
                                    </td>
                                    <td class="shoping__cart__price">
                                        $69.00
                                    </td>
                                    <td class="shoping__cart__price">
                                        {{ $cart->product_price }} VND
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="hidden"
                                                    name="productDetail[{{ $key }}][productDetailId]"
                                                    value="{{ $cart->product_detail_id }}">
                                                <input type="hidden" name="productId"
                                                    value="{{ optional($cart->product())->first()->id }}">
                                                <span class="dec qtybtn dec-{{ $cart->product_detail_id }}"
                                                    data-product-id="{{ $cart->product_detail_id }}"
                                                    data-initial-quantity="{{ $cart->product_quantity }}"
                                                    data-max-quantity="{{ $cart->productDetail->quantity + $cart->product_quantity }}"
                                                    data-cart-id="{{ $cart->id }}"
                                                    data-action="{{ route('frontend.carts.updateProductInCart', ['productDetailId' => $cart->product_detail_id, 'cartId' => $cart->id]) }}"
                                                    data-action-delete-single="{{ route('frontend.carts.deleteProductFromCart', ['productDetailId' => $cart->product_detail_id, 'cartId' => $cart->id]) }}">-</span>
                                                <input
                                                    class="quantityInput-{{ $cart->product_detail_id }} input-quantity"
                                                    type="number" value="{{ $cart->product_quantity }}"
                                                    name="productDetail[{{ $key }}][quantity]"
                                                    defaultValue="{{ $cart->product_quantity }}" min="0"
                                                    data-product-id="{{ $cart->product_detail_id }}"
                                                    data-initial-quantity="{{ $cart->product_quantity }}"
                                                    data-max-quantity="{{ $cart->productDetail->quantity + $cart->product_quantity }}"
                                                    data-cart-id="{{ $cart->id }}"
                                                    data-action="{{ route('frontend.carts.updateProductInCart', ['productDetailId' => $cart->product_detail_id, 'cartId' => $cart->id]) }}"
                                                    data-action-delete="{{ route('frontend.carts.deleteProductFromCart', ['productDetailId' => $cart->product_detail_id, 'cartId' => $cart->id]) }}">
                                                <span class="inc qtybtn inc-{{ $cart->product_detail_id }}"
                                                    data-product-id="{{ $cart->product_detail_id }}"
                                                    data-initial-quantity="{{ $cart->product_quantity }}"
                                                    data-max-quantity="{{ $cart->productDetail->quantity + $cart->product_quantity }}"
                                                    data-cart-id="{{ $cart->id }}"
                                                    data-action="{{ route('frontend.carts.updateProductInCart', ['productDetailId' => $cart->product_detail_id, 'cartId' => $cart->id]) }}"
                                                    data-action-delete-single="{{ route('frontend.carts.deleteProductFromCart', ['productDetailId' => $cart->product_detail_id, 'cartId' => $cart->id]) }}">+</span>
                                                @include(
                                                    'frontend.pages.carts.partials.show-modal-delete',
                                                    [
                                                        'cartId' => $cart->id,
                                                    ]
                                                )

                                                @include(
                                                    'frontend.pages.carts.partials.show-modal-max-quantity',
                                                    [
                                                        'cartId' => $cart->id,
                                                        'maxQuantity' =>
                                                            $cart->productDetail->quantity +
                                                            $cart->product_quantity,
                                                    ]
                                                )
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        {{ $cart->product_price * $cart->product_quantity }} VND
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <span class="delete-product" data-cart-id="{{ $cart->id }}"
                                            data-action="{{ route('frontend.carts.deleteProductFromCart', ['productDetailId' => $cart->product_detail_id, 'cartId' => $cart->id]) }}"
                                            data-product-id="{{ $cart->product_detail_id }}"><i
                                                class="fas fa-times"></i></span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">@lang('There are no products in the cart')</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        <li>Subtotal <span>{{ $priceAllProductInCart }} VND</span></li>
                        {{-- <li>Ship <span>$454.98</span></li> --}}
                        <li>Coupon <span>$454.98</span></li>
                        <li style="color:red">@lang('Total') <span>$454.98</span></li>
                    </ul>
                    <button type="submit" class="btn primary-btn right-align">@lang('PROCEED TO CHECKOUT')</button>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{ asset('js/pages/product/cart.js') }}"></script>
<script src="{{ asset('js/pages/cart/ajaxCart.js') }}"></script>
