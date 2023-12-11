@extends('frontend.layouts.app')

@section('title', __('Cart'))

@section('content')
    <div class="fade-in">
        @include('includes.partials.messages')
    </div>
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('storage/images/carts/default/default.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2 class="text-align: center">@lang('Shopping Cart')</h2>
                        <div class="breadcrumb__option">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>@lang('Discount Codes')</h5>
                            <form id="search-form" action="{{ route('frontend.carts.applyCoupon') }}" method="POST">
                                @csrf
                                <div id="checkDeleteCouponInCart"></div>
                                <input type="hidden" name="old_coupon_name"
                                    value="{{ session()->get('coupon_name') ?? null }}">
                                <input type="text" name="coupon_code" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('frontend.pages.carts.partials.show-tag-filter')
    </section>

    <div id="renderCart">
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
                                                {{ $cart->productDetail->color }}
                                            </td>
                                            <td class="shoping__cart__price">
                                                {{ $cart->productDetail->size }}
                                            </td>
                                            <td class="shoping__cart__price">
                                                @if (isset($cart->productDetail->salePrice))
                                                    <span>
                                                        {{ $cart->productDetail->reducedValue }}{{ $cart->productDetail->reducedType == 1 ? 'VND' : '%' }}
                                                    </span>
                                                @elseif(isset($cart->productDetail->salePriceGlobal))
                                                    <span>
                                                        {{ $cart->productDetail->reducedValue }}{{ $cart->productDetail->reducedType == 1 ? 'VND' : '%' }}
                                                    </span>
                                                @else
                                                    @lang('There are no sale price')
                                                @endif
                                            </td>
                                            <td class="shoping__cart__price">
                                                @if (isset($cart->productDetail->salePrice))
                                                    <span style="text-decoration: line-through">
                                                        {{ $cart->productDetail->price }} @lang('VND')
                                                    </span>
                                                    <br>
                                                    {{ $cart->productDetail->salePrice }} @lang('VND')
                                                @elseif(isset($cart->productDetail->salePriceGlobal))
                                                    <span style="text-decoration: line-through">
                                                        {{ $cart->productDetail->price }} @lang('VND')
                                                    </span>
                                                    <br>
                                                    {{ $cart->productDetail->salePriceGlobal }} @lang('VND')
                                                @else
                                                    {{ $cart->productDetail->price }} @lang('VND')
                                                @endif
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
                                                @if (isset($cart->productDetail->salePrice))
                                                    {{ $cart->productDetail->salePrice * $cart->product_quantity }}
                                                    @lang('VND')
                                                @elseif(isset($cart->productDetail->salePriceGlobal))
                                                    {{ $cart->productDetail->salePriceGlobal * $cart->product_quantity }}
                                                    @lang('VND')
                                                @else
                                                    {{ $cart->productDetail->price * $cart->product_quantity }}
                                                    @lang('VND')
                                                @endif
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
                                <li>@lang('Subtotal') <span>{{ $subPriceAllProductInCart }} VND</span></li>
                                @if (session()->has('coupon_name'))
                                    <li>@lang('Coupon')
                                        @if (session('coupon_type') == config('constants.coupon.percent'))
                                            (%)
                                        @else
                                            (VND)
                                        @endif
                                        <span>{{ session('coupon_value') }} @if (session('coupon_type') == config('constants.coupon.percent'))
                                                %
                                            @else
                                                VND
                                            @endif
                                        </span>
                                    </li>
                                @endif
                                <li style="color:red">@lang('Total') <span>{{ $priceAllProductInCart }} VND</span></li>
                            </ul>
                            <button type="submit" class="btn primary-btn right-align">@lang('PROCEED TO CHECKOUT')</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                    <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                        Upadate Cart</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script src="{{ asset('js/pages/product/cart.js') }}"></script>
    <script src="{{ asset('js/pages/cart/ajaxCart.js') }}"></script>
    <script src="{{ asset('js/pages/cart/filter.js') }}"></script>
@endpush

</div>
