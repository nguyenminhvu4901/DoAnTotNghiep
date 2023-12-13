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
                <form action="#">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>@lang('Name')<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>@lang('Email')<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>@lang('Phone Number')<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>@lang('Province')<span>*</span></p>
                                        <select class="form-control w-100 filter-select" id="">
                                            <option value="">123</option>
                                            <option value="">123</option>
                                            <option value="">123</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>@lang('District')<span>*</span></p>
                                        <select class="form-control filter-select" id="">
                                            <option value="">123</option>
                                            <option value="">456</option>
                                            <option value="">789</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>@lang('Ward')<span>*</span></p>
                                        <select class="form-control w-100 filter-select" id="">
                                            <option value="">123</option>
                                            <option value="">123</option>
                                            <option value="">123</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>@lang('Address')<span>*</span></p>
                                        <input type="text" name="address">
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
                                        <input type="hidden" name="productDetailId"
                                            value="{{ $product->productDetailId }}">
                                        <li>{{ $product->quantity }}x
                                            <a
                                                href="{{ route('frontend.products.detail', ['id' => $product->productId]) }}">
                                                {{ $product->nameProduct }} </a>
                                            (@lang('Color'): {{ $product->color }}, @lang('Size'):
                                            {{ $product->size }})
                                            <span>${{ $product->price }}</span>
                                        </li>
                                    </ul>
                                @empty
                                @endforelse
                                <div class="checkout__order__subtotal">Subtotal <span>{{ $subAllProduct }}</span></div>
                                @if (isset($couponName))
                                    <div class="checkout__order__subtotal">@lang('Coupon') <span>{{ $couponName }}
                                            ({{ $couponValue }}{{ $couponType == config('constants.coupon.percent') ? '%' : 'VND' }})</span>
                                    </div>
                                @endif
                                <div class="checkout__order__total">Total <span>{{ $totalAllProduct }}</span></div>
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
@endpush
