@extends('frontend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <div class="fade-in">
        @include('includes.partials.messages')
    </div><!--fade-in-->
    <!-- Header Section Begin -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class=" @if (isCurrentRouteInRoutes('frontend.user.dashboard')) active @endif">
                                <a href="{{ route('frontend.user.dashboard') }}">@lang('Home')</a></li>
                            <li><a href="./shop-grid.html">@lang('Sale off')</a></li>
                            <li><a href="./contact.html">@lang('Coupon')</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hero__item set-bg" data-setbg="{{ asset('img/header/jewelry.png') }}">
                        <div class="hero__text">
                            <h2>@lang('Quality jewelry')</h2>
                            <h5>@lang('Free Pickup and Delivery Available')</h5>
                            <a href="#" class="primary-btn">@lang('SHOP NOW')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>@lang('Featured Product')</h2>
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
                <div class="d-flex align-items-center justify-content-md-end">
                    <a class="btn-footer-modal btn btn-warning rounded-10"
                       href="{{ route('frontend.products.index') }}">@lang('See all') <i
                                class="fas fa-arrow-circle-right"></i>
                    </a>
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
                                        <li><a href="{{ route('frontend.products.detail', ['id' => $product->id]) }}"><i
                                                        class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h6>
                                        <a href="{{ route('frontend.products.detail', ['id' => $product->id]) }}">{{ __($product->name) }}</a>
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

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="https://images.squarespace-cdn.com/content/v1/59c406ae8a02c798d1ca155f/3d8fcdb5-3ebe-4661-b651-1cfc2d691e6c/Special+Occasion+Earring+Slider.png" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="https://images.squarespace-cdn.com/content/v1/548fcaa5e4b00cdae11c4e35/0c093d87-8281-43de-bf01-a17416ab2a19/JUST+IN.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>From The Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-1.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Cooking tips make cooking simple</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-2.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">6 ways to prepare breakfast for 30</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-3.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Visit the clean farm in the US</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>@lang('Featured coupon')</h2>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="flex-grow-1">
                    <form id="search-form" class="d-flex align-items-center" action="" method="GET">
                        <div class="nav-search-bar d-inline-flex" style="width:500px">
                            <input class="form-control flex-grow-1" type="text" placeholder="@lang('Search')..."
                                   value="{{ old('search', request()->get('search')) }}" name="search">
                            <button class="border-0 bg-transparent" type="submit">
                                <i class="fas fa-search" style="color: #1561e5;"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <div class="render-product-dashboard">
                <div class="row featured__filter">
                    @forelse($coupons as $coupon)
                        <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg"
                                     data-setbg="{{ asset('storage/images/coupons/default/voucher.png') }}">
                                    <ul class="featured__item__pic__hover">
                                        {{--                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>--}}
                                        <li>
                                            <a href="{{ route('frontend.coupons.detail', ['slug' => $coupon->slug]) }}"><i
                                                        class="fa fa-info-circle"></i></a>
                                        </li>
                                        {{--                                    <li><a href="{{ route('frontend.products.detail', ['id' => $product->id]) }}"><i class="fa fa-shopping-cart"></i></a></li>--}}
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h6>
                                        <a href="{{ route('frontend.coupons.detail', ['slug' => $coupon->id]) }}">{{ __($coupon->name) }}</a>
                                    </h6>
                                    <h5>  {{ $coupon->value}}{{$coupon->formatted_type_coupon}}</h5>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg"
                                     data-setbg="{{ asset('storage/images/coupons/default/voucher.png') }}">
                                    <ul class="featured__item__pic__hover">
                                        {{--                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>--}}
{{--                                        <li>--}}
{{--                                            <a href="#"><i class="fa fa-info-circle"></i></a>--}}
{{--                                        </li>--}}
                                                                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h6><a href="#">@lang('There are no coupons')</a></h6>
                                    @isset($coupon)
                                        <h5> {{ __('N/A') }}</h5>
                                    @endisset
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
                <div class="pagination container-fluid pt-2 position-sticky">
                    {{ $coupons->onEachSide(1)->appends(request()->only('search', 'categories', 'products', 'search-product'))->links('frontend.includes.custom-pagination') }}
                </div>
            </div>
        </div>
    </section>
    <!-- Featured Section End -->
@endsection

@push('after-scripts')
    @if (session()->has('X-Clear-LocalStorage'))
        <script src="{{ asset('js/pages/dashboard/clearLocalStorage.js') }}"></script>
    @endif
    <script src="{{ asset('js/pages/filter.js') }}"></script>
@endpush
