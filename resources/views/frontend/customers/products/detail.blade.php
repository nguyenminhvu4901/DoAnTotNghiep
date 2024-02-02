@extends('frontend.layouts.app')

@section('title', __('PRODUCT DETAIL'))

@section('content')
    <div class="fade-in">
        @include('includes.partials.messages')
    </div><!--fade-in-->

    <div class="mt-4 rounded bg-white">
        <div class="p-3 pl-2 font-weight-bold text-center pb-5">
            <h3>
                @lang('PRODUCT DETAIL')
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
                                             src="{{ isset($productImages) && !$productImages->isEmpty()
                                                ? $productImages->first()->getImageUrlAttribute()
                                                : asset('storage/images/products/default/ProductImageDefault.jpg') }}"
                                             alt="">
                                    </div>
                                </div>
                                <div class="product__details__pic__slider owl-carousel">
                                    @forelse ($productImages as $productImage)
                                        <div class="border border-secondary">
                                            <img class="img-fluid"
                                                 style=" width: 200px; height: 80px; object-fit: cover;"
                                                 data-imgbigurl="{{ $productImage->getImageUrlAttribute() }}"
                                                 src="{{ $productImage->getImageUrlAttribute() }}" width="100"
                                                 alt="">
                                        </div>
                                    @empty
                                        <div class="border border-secondary">
                                            <img class="img-fluid"
                                                 style=" width: 200px; height: 200px; object-fit: cover;"
                                                 data-imgbigurl="{{ asset('storage/images/products/default/ProductImageDefault.jpg') }}"
                                                 src="{{ asset('storage/images/products/default/ProductImageDefault.jpg') }}"
                                                 alt="">
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="product__details__text">
                                <h3>{{ $product->name }}</h3>
                                <div class="product__details__rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <span>@lang('(18 reviews)')</span>
                                </div>
                                <div class="product__details__price">
                                    {{ !$product->productDetail->isEmpty() ? formatMoney($product->productDetail->min('price')) . ' - ' . formatMoney($product->productDetail->max('price')) : __('N/A') }}
                                </div>
                                <a href="#modalCart-{{ $product->id }}" data-toggle="modal" class="primary-btn">
                                    @lang('ADD TO CART')
                                </a>
                                @include('frontend.customers.products.partials.show-modal-cart', [
                                    'productId' => $product->id,
                                ])
                                {{--                                <a href="#" class="heart-icon"><i class="fas fa-heart"></i></a>--}}
                                <ul>
                                    <li><b>@lang('Availability')</b> <span>@lang('In Stock')</span></li>
                                    <li><b>@lang('Shipping')</b> <span>@lang('01 day shipping.')</span>
                                    </li>
{{--                                    <li><b>@lang('Weight')</b> <span>@lang('0.5 kg')</span></li>--}}
                                    <li><b>@lang('Share on')</b>
                                        <div class="share">
                                            <a href="#"><i class="fab fa-facebook"></i></a>
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                            <a href="#"><i class="fab fa-instagram"></i></a>
                                            <a href="#"><i class="fab fa-pinterest"></i></a>
                                        </div>
                                    </li>
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
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                           aria-selected="false">@lang('Reviews')</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                        <div class="product__details__tab__desc">
                                            <h6>@lang('Products Infomation')</h6>
                                            <p>{!! $product->description !!}</p>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabs-2" role="tabpanel">
                                        <div class="product__details__tab__desc">
                                            <h6>@lang('Reviews')</h6>
                                            <h6>@lang('This functionality is under development!')</h6>
                                            <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                                Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                                Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac
                                                diam
                                                sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue
                                                leo
                                                eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                                Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.
                                                Praesent
                                                sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum
                                                ac
                                                diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                                ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                                Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet
                                                ligula.
                                                Proin eget tortor risus.</p>
                                        </div>
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

    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>@lang('Similar Products')</h2>
                    </div>
                </div>
            </div>
            <div class="render-product-dashboard">
                <div class="row featured__filter">
                    @forelse($similarProducts as $product)
                        <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                            <div class="featured__item parent-featured__item">
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
                                        @isset($product)
                                            <h5> {{ !$product->productDetail->isEmpty() ? 'đ '. $product->productDetail->min('price') . ' - ' . $product->productDetail->max('price') : __('N/A') }}</h5>
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

@endsection

@push('after-scripts')
    <script src="{{ asset('js/pages/product/detail.js') }}"></script>
    <script src="{{ asset('js/pages/product/cart.js') }}"></script>
@endpush
