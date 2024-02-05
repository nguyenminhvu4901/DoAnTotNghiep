@extends('frontend.layouts.app')

@section('title', __('List Of Product'))

@section('content')
    <div class="fade-in">
        @include('includes.partials.messages')
    </div><!--fade-in-->

    <section>
        <div class="container">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="height: initial">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100"
                             src="{{ asset('storage/images/dashboard/banner/banner-favourite-1.jpg') }}"
                             alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100"
                             src=" {{ asset('storage/images/dashboard/banner/banner-favourite-2.jpg') }}"
                             alt="Second slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>@lang('List Of Favourite Product')</h2>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="">
                    <form id="search-form" class="d-flex align-items-center" action="" method="GET">
                        <div class="nav-search-bar d-inline-flex" style="width: 500px">
                            <input class="form-control flex-grow-1" type="text" placeholder="@lang('Search')..."
                                   value="{{ old('search', request()->get('search')) }}"
                                   name="search-product">
                            <button class="border-0 bg-transparent" type="submit">
                                <i class="fas fa-search" style="color: #1561e5;"></i>
                            </button>
                        </div>
                        @include('frontend.pages.favourites.partials.show-modal-filter')
                    </form>
                </div>
            </div>
            <br>
            @include('frontend.pages.favourites.partials.show-tag-filter')
            <br>
            <div class="render-product-dashboard">
                <div class="row featured__filter">
                    @forelse($favourites as $favourite)
                        <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                            <div class="featured__item parent-featured__item"
                                 style="border: 2px solid #fa8c8c !important">
                                <div class="featured__item">
                                    <div class="featured__item__pic set-bg"
                                         data-setbg="{{ isset($favourite->product->productImages) && !$favourite->product->productImages->isEmpty()
                                                ? $favourite->product->productImages->first()->getImageUrlAttribute()
                                                : asset('storage/images/products/default/ProductImageDefault.jpg') }}">
                                        <ul class="featured__item__pic__hover">
                                            <li>
                                                <form action="{{ route('frontend.favourites.deleteFavourite', ['product_id' => $favourite->product_id]) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">
                                                        <i class="fas fa-heart-broken"></i>
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <a href="{{ route('frontend.dashboard.products.detail', ['id' => $favourite->product_id]) }}"><i
                                                            class="fa fa-shopping-cart"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="featured__item__text">
                                        <h6>
                                            <a href="{{ route('frontend.dashboard.products.detail', ['id' => $favourite->product_id]) }}">{{ __($favourite->product->name) }}</a>
                                        </h6>
                                        <h5> {{ !$favourite->product->productDetail->isEmpty() ? formatMoney($favourite->product->productDetail->min('price')) . ' - ' . formatMoney($favourite->product->productDetail->max('price')) : __('N/A') }}</h5>
                                        <hr>
                                        <strong>@lang('Average price') {{ formatMoney($favourite->product->productDetail->avg('price')) }}</strong>
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
                                            <li><a href="#">
                                                    <i class="fa fa-retweet"></i>
                                                </a></li>
                                        </ul>
                                    </div>
                                    <div class="featured__item__text">
                                        <h6><a href="#">@lang('There are currently no products')</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
                <div class="pagination container-fluid pt-2 position-sticky">
                    {{ $favourites->onEachSide(1)->appends(request()->only('search', 'categories', 'products', 'search-product', 'order_by', 'colors', 'sizes', 'min_price', 'max_price'))->links('frontend.includes.custom-pagination') }}
                </div>
            </div>
        </div>
    </section>
    <!-- Featured Section End -->
@endsection

@push('after-scripts')
    <script src="{{ asset('js/pages/filter.js') }}"></script>
@endpush
