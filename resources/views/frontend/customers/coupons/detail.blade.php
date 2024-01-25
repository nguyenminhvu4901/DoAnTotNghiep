@extends('frontend.layouts.app')

@section('title', __('COUPON DETAIL'))

@section('content')
    <div class="fade-in">
        @include('includes.partials.messages')
    </div><!--fade-in-->

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
                                @if(auth()->user()->isRoleCustomer())
                                    <li class="@if (isCurrentRouteInRoutes('frontend.carts.*')) active @endif">
                                        <a href="{{ route('frontend.carts.index') }}">@lang('Cart')</a>
                                    </li>
                                @endif
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

    <div class="mt-4 rounded bg-white">
        <div class="p-3 pl-2 font-weight-bold text-center pb-5">
            <h3>
                @lang('COUPON DETAIL')
            </h3>
        </div>
        <div class="px-3 pb-3">
            <section class="product-details spad">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="product__details__pic">
                                <div class="product__details__pic__item">
                                    <div class="border border-secondary">
                                        <img class="product__details__pic__item--large"
                                             style=" width: 600px; height: 300px; object-fit: cover;"
                                             src="{{ asset('storage/images/coupons/default/voucher.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="d-flex align-items-center">
                                <h3 class="name-coupon">{{ $coupon->name }}</h3>
                                <button type="button" class="btn copy-name-coupon"
                                        data-sub="{{ json_encode(['copy' => __('Copied to Clipboard')]) }}"><i
                                            class="fas fa-copy"></i></button>
                                <span class="fbm-copied-message"></span>
                            </div>
                            <div class="voucher_detail">
                                {{ $coupon->value}}{{$coupon->formatted_type_coupon}}
                            </div>
                            <ul>
                                <li><b>@lang('Start date')</b> <span>{{ $coupon->formatted_start_date_at }}</span></li>
                                <li><b>@lang('End date')</b> <span>{{ $coupon->formatted_expiry_date_at }}</span></li>
                                <li><b>@lang('Quantity')</b> <span>{{ $coupon->quantity }}</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                       aria-selected="true">@lang('Information')</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                    <div class="product__details__tab__desc">
                                        <h6>@lang('Coupon Information')</h6>
                                        <p>{!! $coupon->description !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Product Details Section End -->
        </div>
    </div>
@endsection

@push('after-scripts')
    <script src="{{ asset('js/pages/product/detail.js') }}"></script>
    <script src="{{ asset('js/pages/product/cart.js') }}"></script>
    <script src="{{ asset('js/pages/coupon/copy.js') }}"></script>
@endpush
