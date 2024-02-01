@extends('frontend.layouts.app')

@section('title', __('Cart'))

@section('content')
    <div class="fade-in">
        @include('includes.partials.messages')
    </div>

    <input type="hidden" class="sub-js" data-sub="{{ json_encode([
        'delete_success' => __('Successfully removed product from cart.'),
        'delete_unsuccess' => __('An error occurred, please try again.')
    ]) }}">
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
                                <input type="text" name="coupon_code" placeholder="@lang('Enter your coupon code')">
                                <button type="submit" class="site-btn">@lang('APPLY COUPON')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @include('frontend.pages.carts.partials.show-tag-filter')
        </div>
    </section>

    <div id="renderCart">
        <form action="{{ route('frontend.orders.checkout') }}" method="GET">
            @csrf
            <section class="shoping-cart spad">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="shoping__cart__table">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="shoping__product">@lang('Products')</th>
                                        <th>@lang('Color')</th>
                                        <th>@lang('Size')</th>
                                        <th>@lang('Sale')</th>
                                        <th>@lang('Price')</th>
                                        <th>@lang('Quantity')</th>
                                        <th>@lang('Total')</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($carts as $key => $cart)
                                        <tr>
                                            <td class="shoping__cart__item">
                                                <input type="hidden" name="productDetail[{{ $key }}][name]"
                                                       value="{{ optional($cart->product())->first()->name }}">
                                                <input type="hidden" name="productDetail[{{ $key }}][productId]"
                                                       value="{{ $cart->productDetail->product_id }}">
                                                <h4>{{ optional($cart->product())->first()->name }}</h4>
                                                <br>
                                                <img src="{{ $cart->image_product_in_cart}}"
                                                     width="150px" height="150px">
                                            </td>
                                            <td class="shoping__cart__price">
                                                <input type="hidden" name="productDetail[{{ $key }}][color]"
                                                       value="{{ $cart->productDetail->color }}">
                                                {{ $cart->productDetail->color }}
                                            </td>
                                            <td class="shoping__cart__price">
                                                <input type="hidden" name="productDetail[{{ $key }}][size]"
                                                       value="{{ $cart->productDetail->size }}">
                                                {{ $cart->productDetail->size }}
                                            </td>
                                            <td class="shoping__cart__price">
                                                @if (isset($cart->productDetail->salePrice))
                                                    <span>
                                                            {{ $cart->productDetail->reducedValue }}{{ $cart->productDetail->reducedType == 1 ? 'đ' : '%' }}
                                                        </span>
                                                @elseif(isset($cart->productDetail->salePriceGlobal))
                                                    <span>
                                                            {{ $cart->productDetail->reducedValue }}{{ $cart->productDetail->reducedType == 1 ? 'đ' : '%' }}
                                                        </span>
                                                @elseif(isset($cart->productDetail->salePriceCategory))
                                                    <span>
                                                            {{ $cart->productDetail->reducedValue }}{{ $cart->productDetail->reducedType == 1 ? 'đ' : '%' }}
                                                        </span>
                                                @else
                                                    @lang('There are no sale price')
                                                @endif
                                            </td>
                                            <td class="shoping__cart__price">
                                                @if (isset($cart->productDetail->salePrice))
                                                    <span style="text-decoration: line-through">
                                                            {{ formatMoney($cart->productDetail->price) }}
                                                        </span>
                                                    <br>
                                                    {{ formatMoney($cart->productDetail->salePrice) }}
                                                @elseif(isset($cart->productDetail->salePriceGlobal))
                                                    <span style="text-decoration: line-through">
                                                            {{ formatMoney($cart->productDetail->price) }}
                                                        </span>
                                                    <br>
                                                    {{ formatMoney($cart->productDetail->salePriceGlobal) }}
                                                @elseif(isset($cart->productDetail->salePriceCategory))
                                                    <span style="text-decoration: line-through">
                                                            {{ formatMoney($cart->productDetail->price) }}
                                                        </span>
                                                    <br>
                                                    {{ formatMoney($cart->productDetail->salePriceCategory) }}
                                                @else
                                                    {{ formatMoney($cart->productDetail->price) }}
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
                                                @php
                                                    $price = 0;
                                                @endphp
                                                @if (isset($cart->productDetail->salePrice))
                                                    @php
                                                        $price = $cart->productDetail->salePrice * $cart->product_quantity;
                                                    @endphp
                                                @elseif(isset($cart->productDetail->salePriceGlobal))
                                                    @php
                                                        $price = $cart->productDetail->salePriceGlobal * $cart->product_quantity;
                                                    @endphp
                                                @elseif(isset($cart->productDetail->salePriceCategory))
                                                    @php
                                                        $price = $cart->productDetail->salePriceCategory * $cart->product_quantity;
                                                    @endphp
                                                @else
                                                    @php
                                                        $price = $cart->productDetail->price * $cart->product_quantity;
                                                    @endphp
                                                @endif
                                                {{ formatMoney($price) }}
                                                <input type="hidden" name="productDetail[{{ $key }}][price]"
                                                       value="{{ $price }}">
                                            </td>
                                            <td class="shoping__cart__item__close">
                                                    <span class="delete-product" data-cart-id="{{ $cart->id }}"
                                                          data-action="{{ route('frontend.carts.deleteProductFromCart', ['productDetailId' => $cart->product_detail_id, 'cartId' => $cart->id]) }}"
                                                          data-product-id="{{ $cart->product_detail_id }}"
                                                    >
                                                        <i class="fas fa-times"></i>
                                                    </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8"
                                                class="text-center">@lang('There are no products in the cart')</td>
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
                                <h5>@lang('Cart Total')</h5>
                                <ul>
                                    <li>@lang('Subtotal') <span>{{ formatMoney($subPriceAllProductInCart) }}</span></li>
                                    <input type="hidden" name="subAllProduct" value="{{ $subPriceAllProductInCart }}">
                                    @if (session()->has('coupon_name'))
                                        <li>@lang('Coupon')
                                            @if (session('coupon_type') == config('constants.coupon.percent'))
                                                (%)
                                            @else
                                                (đ)
                                            @endif
                                            <span>{{ session('coupon_value') }} @if (session('coupon_type') == config('constants.coupon.percent'))
                                                    %
                                                @else
                                                    đ
                                                @endif
                                            </span>
                                        </li>
                                        <input type="hidden" name="couponValue" value="{{ session('coupon_value') }}">
                                        <input type="hidden" name="couponName" value="{{ session('coupon_name') }}">
                                        <input type="hidden" name="couponType" value="{{ session('coupon_type') }}">
                                        <input type="hidden" name="couponId" value="{{ session('coupon_id') }}">
                                    @endif
                                    <input type="hidden" name="totalAllProduct" value="{{ $priceAllProductInCart }}">
                                    <li style="color:red">@lang('Total')
                                        <span>{{ formatMoney($priceAllProductInCart) }}</span>
                                    </li>
                                </ul>
                                <button type="submit"
                                        class="btn primary-btn right-align ">@lang('PROCEED TO CHECKOUT')</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </div>
@endsection

@push('after-scripts')
    <script src="{{ asset('js/pages/product/cart.js') }}"></script>
    <script src="{{ asset('js/pages/cart/ajaxCart.js') }}"></script>
    <script src="{{ asset('js/pages/cart/filter.js') }}"></script>
    @endpush

    </div>
