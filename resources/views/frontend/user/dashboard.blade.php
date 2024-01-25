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
                       href="{{ route('frontend.dashboard.products.index') }}">@lang('See all') <i
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
                                        <li>
                                            <a href="{{ route('frontend.dashboard.products.detail', ['id' => $product->id]) }}"><i
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

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{ asset('storage/images/dashboard/banner1.jpg') }}"
                             alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{ asset('storage/images/dashboard/banner2.jpg') }}"
                             alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{ asset('storage/images/dashboard/banner3.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{ asset('storage/images/dashboard/banner4.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

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
                <div class="d-flex align-items-center justify-content-md-end">
                    <a class="btn-footer-modal btn btn-warning rounded-10"
                       href="{{ route('frontend.coupons.index') }}">@lang('See all') <i
                                class="fas fa-arrow-circle-right"></i>
                    </a>
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
                                            <a href="{{ route('frontend.dashboard.coupons.detail', ['slug' => $coupon->slug]) }}"><i
                                                        class="fa fa-info-circle"></i></a>
                                        </li>
                                        {{--                                    <li><a href="{{ route('frontend.products.detail', ['id' => $product->id]) }}"><i class="fa fa-shopping-cart"></i></a></li>--}}
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h6>
                                        <a class="name-coupon"
                                           href="{{ route('frontend.dashboard.coupons.detail', ['slug' => $coupon->slug]) }}">
                                            {{ __($coupon->name) }}
                                        </a>
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

    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>@lang('Blogs')</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{ asset('storage/images/dashboard/blog1.jpg') }}" alt="" width="300px"
                                 height="300px">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fas fa-calendar"></i> May 4,2019</li>
                                <li><i class="fas fa-comment"></i> 5</li>
                            </ul>
                            <h5>
                                <a href="https://heliosjewels.vn/blogs/tin-tuc/5-dia-chi-ban-trang-suc-bac-ca-tinh-trong-dip-black-friday-ma-ban-khong-nen-bo-qua">5
                                    Địa chỉ bán trang sức bạc cá tính trong dịp back friday mà bạn không nên bỏ qua</a>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{ asset('storage/images/dashboard/blog2.jpg') }}" alt="" width="300px"
                                 height="300px">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fas fa-calendar"></i> May 4,2019</li>
                                <li><i class="fas fa-comment"></i> 5</li>
                            </ul>
                            <h5><a href="https://heliosjewels.vn/blogs/tin-tuc/nhan-trang-suc-nam-co-gi-dac-biet">Nhẫn
                                    trang sức nam có gì đặc biệt? Vì sao nam giới nên đeo nhẫn?</a></h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{ asset('storage/images/dashboard/blog3.jpg') }}" alt="" width="300px"
                                 height="300px">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fas fa-calendar"></i> May 4,2019</li>
                                <li><i class="fas fa-comment"></i> 5</li>
                            </ul>
                            <h5><a href="https://heliosjewels.vn/blogs/tin-tuc/nhung-mau-khuyen-tai-vang-ma-ban-nen-co">Những
                                    mẫu khuyên tai vàng mà bạn nam nên có</a></h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{ asset('storage/images/dashboard/blog4.jpg') }}" alt="" width="300px"
                                 height="300px">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fas fa-calendar"></i> May 4,2019</li>
                                <li><i class="fas fa-comment"></i> 5</li>
                            </ul>
                            <h5><a href="https://heliosjewels.vn/blogs/tin-tuc/lac-tay-bac-phong-cach-va-y-nghia">
                                    Lắc Tay Bạc: Phong Cách và Ý Nghĩa
                                </a></h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{ asset('storage/images/dashboard/blog6.jpg') }}" alt="" width="300px"
                                 height="300px">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fas fa-calendar"></i> May 4,2019</li>
                                <li><i class="fas fa-comment"></i> 5</li>
                            </ul>
                            <h5>
                                <a href="https://heliosjewels.vn/blogs/tin-tuc/deo-nhan-tay-phai-tin-hieu-cua-su-thanh-cong-va-quyen-luc">
                                    Đeo nhẫn tay phải: Tín hiệu của sự thành công và quyền lực
                                </a></h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{ asset('storage/images/dashboard/blog5.jpg') }}" alt="" width="300px"
                                 height="300px">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fas fa-calendar"></i> May 4,2019</li>
                                <li><i class="fas fa-comment"></i> 5</li>
                            </ul>
                            <h5><a href="https://heliosjewels.vn/blogs/tin-tuc/chon-nhan-cho-nguoi-co-ngon-tay-ngan">
                                    Chọn nhẫn cho người ngón tay ngắn
                                </a></h5>
                        </div>
                    </div>
                </div>
                <a class="btn-footer-modal btn btn-success rounded-10 ml-auto"
                   href="https://heliosjewels.vn/blogs/tin-tuc">@lang('See more')
                </a>
            </div>
        </div>

    </section>
@endsection

@push('after-scripts')
    @if (session()->has('X-Clear-LocalStorage'))
        <script src="{{ asset('js/pages/dashboard/clearLocalStorage.js') }}"></script>
    @endif
    <script src="{{ asset('js/pages/filter.js') }}"></script>
@endpush
