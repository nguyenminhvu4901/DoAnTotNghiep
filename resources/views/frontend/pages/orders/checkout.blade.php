@extends('frontend.layouts.app')

@section('title', __('Cart'))

@section('content')
    <style>
        .product-information-checkout {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .product-link-checkout {
            width: 50% !important;
        }

        .product-price-checkout {
            width: 30% !important;
            text-align: right;
        }

        .vertical-line {
            border-left: 2px solid #000 !important; /* Adjust the color and thickness as needed */
            height: 100px !important; /* Adjust the height as needed */
            margin: 0 10px !important; /* Adjust the margin as needed */
        }
    </style>

    @if(auth()->user()->isRoleCustomer())
        <header class="header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <nav class="header__menu">
                            <ul>
                                <li class="@if (isCurrentRouteInRoutes('frontend.user.dashboard')) active @endif">
                                    <a href="{{ route('frontend.user.dashboard') }}">@lang('Home')</a>
                                </li>
                                <li class="@if (isCurrentRouteInRoutes('frontend.dashboard.products.*')) active @endif">
                                    <a href="{{ route('frontend.dashboard.products.index') }}">@lang('Product')</a>
                                </li>
                                <li class="@if (isCurrentRouteInRoutes('frontend.dashboard.coupons.*')) active @endif">
                                    <a href="{{ route('frontend.dashboard.coupons.index') }}">@lang('Coupon')</a>
                                </li>
                                <li class="@if (isCurrentRouteInRoutes('frontend.dashboard.sales.*')) active @endif">
                                    <a href="{{ route('frontend.dashboard.sales.index') }}">@lang('Sale off')</a>
                                </li>
                                @auth
                                    <li class="@if (isCurrentRouteInRoutes('frontend.orders.*')) active @endif">
                                        <a href="{{ route('frontend.orders.index') }}">@lang('Order')</a>
                                    </li>
                                    <li class="@if (isCurrentRouteInRoutes('frontend.carts.*')) active @endif">
                                        <a href="{{ route('frontend.carts.index') }}">@lang('Cart')</a>
                                    </li>
                                @endauth
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="humberger__open">
                    <i class="fa fa-bars"></i>
                </div>
            </div>
        </header>
    @endif

    <input type="hidden" class="sub-js" data-sub="{{ json_encode([
        'district' => __('Choose District'),
        'ward' => __('Choose Ward'),
        'unsuccess' => __('An error occurred, please try again!')
    ])
    }}">
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>@lang('Billing Details')</h4>
                <form action="{{ route('frontend.orders.processCheckout') }}" method="POST" id="form-checkout">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>@lang('Name')<span>*</span></p>
                                        <input type="text" name="customer_name" value=" {{ old('customer_name') }}">
                                        <small id="error_order"
                                               class="error text-danger">{{ $errors->first('customer_name') }}</small>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>@lang('Email')<span>*</span></p>
                                        <input type="email" name="customer_email" value=" {{ old('customer_email') }}">
                                        <small id="error_order"
                                               class="error text-danger">{{ $errors->first('customer_email') }}</small>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>@lang('Phone Number')<span>*</span></p>
                                        <input type="number" name="customer_phone" value=" {{ old('customer_phone') }}">
                                        <small id="error_order"
                                               class="error text-danger">{{ $errors->first('customer_phone') }}</small>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>@lang('Province')<span>*</span></p>
                                        <select class="form-control w-100 filter-select" id="select-province"
                                                data-total-cost="{{ $totalAllProduct }}"
                                                data-url-default="{{ route('frontend.orders.getProvinceInVietNam') }}"
                                                name="province">
                                            @if (!empty($provinces))
                                                <option value="default">@lang('Choose Province')</option>
                                                @foreach ($provinces as $province)
                                                    <option class="province-option-{{ $province['ProvinceID'] }}"
                                                            value="{{ $province['ProvinceID'] }}"
                                                            {{ old('province') == $province['ProvinceID'] ? 'selected' : '' }}
                                                            data-url="{{ route('frontend.orders.getDistrictDetail', ['provinceID' => $province['ProvinceID']]) }}"
                                                            data-province-id="{{ $province['ProvinceID'] }}"
                                                            data-province-name="{{ $province['ProvinceName'] }}"
                                                            data-total-cost="{{ $totalAllProduct }}">
                                                        {{ $province['ProvinceName'] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small id="error_order"
                                               class="error text-danger">{{ $errors->first('province_name') }}</small>
                                        <input type="hidden" id="selected-province-name" name="province_name">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>@lang('District')<span>*</span></p>
                                        <div id="district-render">
                                            <select class="form-control w-100 filter-select" id="select-district"
                                                    data-total-cost="{{ $totalAllProduct }}" name="district">
                                                <option value="default">@lang('Choose District')</option>
                                            </select>
                                            <small id="error_order"
                                                   class="error text-danger">{{ $errors->first('district_name') }}</small>
                                            <input type="hidden" id="selected-district-name" name="district_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>@lang('Ward')<span>*</span></p>
                                        <div id="ward-render">
                                            <select class="form-control w-100 filter-select" id="select-ward"
                                                    data-total-cost="{{ $totalAllProduct }}" name="ward">
                                                <option value="default">@lang('Choose Ward')</option>
                                            </select>
                                            <small id="error_order"
                                                   class="error text-danger">{{ $errors->first('ward_name') }}</small>
                                            <input type="hidden" id="selected-ward-name" name="ward_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>@lang('Address')<span>*</span></p>
                                        <input type="text" name="customer_address"
                                               value="{{ old('customer_address') }}">
                                        <small id="error_order"
                                               class="error text-danger">{{ $errors->first('customer_address') }}</small>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>@lang('Payment method')<span>*</span></p>
                                        <select class="form-control w-100 filter-select"
                                                data-total-cost="{{ $totalAllProduct }}" name="payment_method">
                                            <option value="1">@lang('Payment on delivery')
                                            </option>
                                            <option value="2">@lang('Payment via VNPay')</option>
                                            {{-- <option value="3">@lang('Payment via Momo')</option> --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>@lang('Note')</p>
                                        <textarea id="ckeditor" cols="10" rows="5" name="note"
                                                  placeholder="@lang('Note')"
                                                  class="form-control rounded {{ checkDisplayError($errors, 'note') }}">
                                        {{ old('note') ?? (isset($product) ? $product->description : '') }}
                                    </textarea>
                                        <small id="error_order"
                                               class="error text-danger">{{ $errors->first('note') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="checkout__order">
                                <h4>@lang('Your Order')</h4>
                                <div class="checkout__order__products">
                                    @lang('Products')
                                    <span>@lang('Total')</span>
                                </div>
                                @forelse($productDetails as $key => $product)
                                    <ul>
                                        <li>{{ $product->quantity }}x
                                            <input type="hidden"
                                                   name="productDetail[{{ $key }}][productDetailId]"
                                                   value="{{ $product->productDetailId }}">
                                            <input type="hidden" name="productDetail[{{ $key }}][productId]"
                                                   value="{{ $product->productId }}">
                                            <input type="hidden" name="productDetail[{{ $key }}][name]"
                                                   value="{{ $product->nameProduct }}">
                                            <input type="hidden" name="productDetail[{{ $key }}][color]"
                                                   value="{{ $product->color }}">
                                            <input type="hidden" name="productDetail[{{ $key }}][size]"
                                                   value="{{ $product->size }}">
                                            <input type="hidden" name="productDetail[{{ $key }}][quantity]"
                                                   value="{{ $product->quantity }}">
                                            <input type="hidden" name="productDetail[{{ $key }}][price]"
                                                   value="{{ $product->price }}">

                                            <div class="product-information-checkout">
                                                <div class="product-link-checkout">
                                                    <a href="{{ route('frontend.products.detail', ['id' => $product->productId]) }}">
                                                        {{ $product->nameProduct }}
                                                    </a>
                                                    ( @lang('Color'): {{ $product->color }}, @lang('Size')
                                                    : {{ $product->size }} )
                                                </div>
                                                <div class="vertical-line"></div>
                                                <div class="product-price-checkout">
                                                    <span>{{ formatMoney($product->price) }}</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <hr>
                                @empty
                                    <p>@lang('No products found')</p>
                                @endforelse
                                <br> <br>
                                <div class="checkout__order__subtotal">@lang('Subtotal')
                                    <input type="hidden" name="subTotalAllProduct" value="{{ $subAllProduct }}">
                                    <span style="color:black">{{ formatMoney($subAllProduct) }}</span>
                                </div>
                                @if (isset($couponName))
                                    <input type="hidden" name="couponValue" value="{{ $couponValue }}">
                                    <input type="hidden" name="couponId" value="{{ $couponId }}">
                                    <input type="hidden" name="couponType" value="{{ $couponType }}">
                                    <div class="checkout__order__total">@lang('Coupon') <span
                                                style="color:black">{{ $couponName }}
                                            ({{ $couponValue }}{{ $couponType == config('constants.coupon.percent') ? '%' : 'VND' }})</span>
                                    </div>
                                    <input type="hidden" name="couponName" value="{{ $couponName }}">
                                @endif
                                <div id="fee-ship">
                                    <div class="checkout__order__total">@lang('Total')
                                        <span>{{ formatMoney($totalAllProduct) }}</span>
                                    </div>
                                </div>
                                <button type="submit" class="site-btn">@lang('PLACE ORDER')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('after-scripts')
    <script src="{{ asset('js/pages/filter.js') }}"></script>
    <script src="{{ asset('js/pages/checkout/address.js') }}"></script>
@endpush
