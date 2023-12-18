@extends('frontend.layouts.app')

@section('title', __('Cart'))

@section('content')
    <div class="fade-in">
        @include('includes.partials.messages')
    </div>
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Billing Details</h4>
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
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>@lang('Email')<span>*</span></p>
                                        <input type="email" name="customer_email" value=" {{ old('customer_email') }}">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>@lang('Phone Number')<span>*</span></p>
                                        <input type="number" name="customer_phone" value=" {{ old('customer_phone') }}">
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
                                                        data-total-cost="{{ $totalAllProduct }}">
                                                        {{ $province['ProvinceName'] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
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
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>@lang('Address')<span>*</span></p>
                                        <input type="text" name="customer_address" value="{{ old('customer_address') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="checkout__order">
                                <h4>@lang('Your Order')</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                @forelse($productDetails as $product)
                                    <ul>
                                        <li>{{ $product->quantity }}x
                                            <a
                                                href="{{ route('frontend.products.detail', ['id' => $product->productId]) }}">
                                                {{ $product->nameProduct }} </a>
                                            (@lang('Color'): {{ $product->color }}, @lang('Size'):
                                            {{ $product->size }})
                                            <span>đ{{ formatMoney($product->price) }}</span>
                                        </li>
                                    </ul>
                                @empty
                                @endforelse
                                <div class="checkout__order__subtotal">Subtotal <span
                                        style="color:black">{{ formatMoney($subAllProduct) }}</span></div>
                                @if (isset($couponName))
                                    <div class="checkout__order__total">@lang('Coupon') <span
                                            style="color:black">{{ $couponName }}
                                            ({{ $couponValue }}{{ $couponType == config('constants.coupon.percent') ? '%' : 'VND' }})</span>
                                    </div>
                                @endif
                                <div id="fee-ship">
                                    <div class="checkout__order__total">Total
                                        <span>{{ formatMoney($totalAllProduct) }}</span>
                                    </div>
                                </div>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
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
