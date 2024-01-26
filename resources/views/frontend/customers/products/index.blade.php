@extends('frontend.layouts.app')

@section('title', __('List Of Product'))

@section('content')
    <div class="fade-in">
        @include('includes.partials.messages')
    </div><!--fade-in-->
    <!-- Header Section Begin -->
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
    <!-- Header Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>@lang('List Of Product')</h2>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="flex-grow-1">
                    <form id="search-form" class="d-flex align-items-center" action="" method="GET">
                        <div class="nav-search-bar d-inline-flex" style="width:500px">
                            <input class="form-control flex-grow-1" type="text" placeholder="@lang('Search')..."
                                   value="{{ old('search-product', request()->get('search-product')) }}"
                                   name="search-product">
                            <button class="border-0 bg-transparent" type="submit">
                                <i class="fas fa-search" style="color: #1561e5;"></i>
                            </button>
                        </div>
                        @include('frontend.pages.products.partials.show-modal-filter')
                    </form>
                </div>
            </div>

            <br>
            @include('frontend.pages.products.partials.show-tag-filter')
            <br>
            <div class="render-product-dashboard">
                <div class="row featured__filter">
                    @forelse($products as $product)
                        <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg"
                                     data-setbg="{{ isset($product->productImages) && !$product->productImages->isEmpty()
                                                ? $product->productImages->first()->getImageUrlAttribute()
                                                : asset('storage/images/products/default/ProductImageDefault.jpg') }}">
                                    <ul class="featured__item__pic__hover">
                                        {{--                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>--}}
                                        {{--                                        <li>--}}
                                        {{--                                            <a href="{{ route('frontend.products.detail', ['id' => $product->id]) }}"><i--}}
                                        {{--                                                        class="fa fa-info-circle"></i></a></li>--}}
                                        <li><a href="{{ route('frontend.dashboard.products.detail', ['id' => $product->id]) }}"><i
                                                        class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h6>
                                        <a href="{{ route('frontend.dashboard.products.detail', ['id' => $product->id]) }}">{{ __($product->name) }}</a>
                                    </h6>
                                    <h5> {{ !$product->productDetail->isEmpty() ? 'đ '. $product->productDetail->min('price') . ' - ' . $product->productDetail->max('price') : __('N/A') }}</h5>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg"
                                     data-setbg="{{ asset('storage/images/products/default/ProductImageDefault.jpg') }}">
                                    <ul class="featured__item__pic__hover">
                                        {{--                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>--}}
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        {{--                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>--}}
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h6><a href="#">@lang('There are currently no products for sale')</a></h6>
                                    @isset($product)
                                        <h5> {{ !$product->productDetail->isEmpty() ? 'đ '. $product->productDetail->min('price') . ' - ' . $product->productDetail->max('price') : __('N/A') }}</h5>
                                    @endisset
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
                <div class="pagination container-fluid pt-2 position-sticky">
                    {{ $products->onEachSide(1)->appends(request()->only('search', 'categories', 'products', 'search-product'))->links('frontend.includes.custom-pagination') }}
                </div>
            </div>
        </div>
    </section>
    <!-- Featured Section End -->
@endsection

@push('after-scripts')
    <script src="{{ asset('js/pages/filter.js') }}"></script>
@endpush