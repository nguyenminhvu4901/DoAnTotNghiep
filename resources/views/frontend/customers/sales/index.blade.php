@extends('frontend.layouts.app')

@section('title', __('List Of Sale Product'))

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
                        <h2>@lang('List Of Sale Product')</h2>
                    </div>
                </div>
            </div>
            <div class="px-3 pb-3 d-flex justify-content-between">
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
                            @include('frontend.pages.sales.partials.show-modal-filter')
                        </form>
                    </div>
                </div>
            </div>
            @include('frontend.pages.sales.partials.show-tag-filter')
            <div class="render-product-dashboard">
                <div class="row featured__filter">
                    @forelse($sales as $sale)
                        <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                            <div class="featured__item parent-featured__item">
                                <div class="featured__item">
                                    <div class="featured__item__pic set-bg"
                                         data-setbg="{{ $sale->category->first() != null  ? asset('storage/images/products/default/category.jpg') :
                                                (isset($sale->product->first()->productImages) && !$sale->product->first()->productImages->isEmpty()
                                                ? $sale->product->first()->productImages->first()->getImageUrlAttribute()
                                                : asset('storage/images/products/default/ProductImageDefault.jpg')) }}">
                                        <ul class="featured__item__pic__hover">
                                            <li>
                                                @if($sale->product->isNotEmpty())
                                                    <a href="{{ route('frontend.dashboard.products.detail', ['id' => $sale->product->first()->id]) }}"><i
                                                                class="fa fa-shopping-cart"></i>
                                                    </a>
                                                @elseif($sale->category->isNotEmpty())
                                                    <a href="{{ route('frontend.dashboard.products.index',  ['categories' => $sale->category->pluck('slug')->toArray()]) }}">
                                                        <i class="fa fa-shopping-cart"></i>
                                                    </a>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                    <hr class="fw-bold border-2 border-dark">
                                    <div class="featured__item__text">
                                        <h6>
                                            @if($sale->category->isNotEmpty())
                                                <a href="{{ route('frontend.dashboard.products.index',  ['categories' => $sale->category->pluck('slug')->toArray()]) }}">
                                                    {{ $sale->category->first()->name }} (@lang('Category'))
                                                </a>
                                            @else
                                                <a href="{{ route('frontend.dashboard.products.detail', ['id' => $sale->product->first()->id]) }}">
                                                    {{ $sale->product->first() == null && $sale->productThroghProductDetail->first() == null
                                        ? __('No Product Sale')
                                        : ($sale->productThroghProductDetail->first() == null
                                            ? $sale->product->first()->name . ' (' . __('All Products') . ')'
                                            : $sale->productThroghProductDetail->first()->name .
                                                ' (' .
                                                $sale->productDetail->first()->size .
                                                ', ' .
                                                $sale->productDetail->first()->color .
                                                ')') }}
                                                </a>
                                            @endif
                                        </h6>
                                        @if($sale->productDetail->isNotEmpty())
                                            @php
                                                $cost = $sale->productDetail->first()->price;
                                                $typeSale = $sale->type;
                                                $valueSale = $sale->value;
                                                $price = 0;

                                                 if($sale->type == config('constants.type_sale.percent')){
                                                        $price = $cost - ($cost * ($valueSale/100));
                                                        if($price < 0)
                                                            {
                                                                $price = 0;
                                                            }
                                                    }else if($sale->type == config('constants.type_sale.percent'))
                                                        {
                                                            $price = $cost - $valueSale;
                                                            if($price < 0)
                                                            {
                                                                $price = 0;
                                                            }
                                                        }
                                            @endphp
                                            <span style="text-decoration: line-through">
                                                            {{ formatMoney($cost) }}
                                        </span>
                                            <br>
                                            {{ formatMoney($price) }}
                                        @elseif($sale->product->isNotEmpty())
                                            @php
                                                $infoProduct = $sale->product->first()->productDetail;
                                                $typeSale = $sale->type;
                                                $valueSale = $sale->value;
                                                $price = 0;
                                                $minPrice = 0;

                                                if($infoProduct->isNotEmpty())
                                                {
                                                    $minPrice = $infoProduct->min('price');
                                                    if($sale->type == config('constants.type_sale.percent')){
                                                        $price = $minPrice - ($minPrice * ($valueSale/100));
                                                        if($price < 0)
                                                            {
                                                                $price = 0;
                                                            }
                                                    }else if($sale->type == config('constants.type_sale.percent'))
                                                        {
                                                            $price = $minPrice - $valueSale;
                                                            if($price < 0)
                                                            {
                                                                $price = 0;
                                                            }
                                                        }
                                                }else{
                                                    $price = __('The product is out of stock');
                                                }
                                            @endphp
                                            <span style="text-decoration: line-through">
                                                            {{ formatMoney($minPrice) }}
                                        </span>
                                            <br>
                                            @php
                                                if(is_string($price))
                                                    {
                                                        echo $price;
                                                    }else{
                                                        echo formatMoney($price);
                                                    }
                                            @endphp
                                        @elseif($sale->category->isNotEmpty())

                                        @else
                                            <strong>@lang('The product is out of stock')</strong>
                                        @endif
                                        <strong> (@lang('Sale') {{ $sale->value }} {{ $sale->formatted_type_sale }}
                                            )</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                            <div class="featured__item parent-featured__item">
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
                                        {{--                                    @isset($product)--}}
                                        {{--                                        <h5> {{ !$product->productDetail->isEmpty() ? 'đ '. $product->productDetail->min('price') . ' - ' . $product->productDetail->max('price') : __('N/A') }}</h5>--}}
                                        {{--                                    @endisset--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
                <div class="pagination container-fluid pt-2 position-sticky">
                </div>
            </div>
        </div>
    </section>
    <!-- Featured Section End -->
@endsection

@push('after-scripts')
    <script src="{{ asset('js/pages/filter.js') }}"></script>
@endpush
