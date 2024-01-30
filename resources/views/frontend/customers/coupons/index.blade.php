@extends('frontend.layouts.app')

@section('title', __('Coupon'))

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
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100"
                             src="{{ asset('storage/images/dashboard/banner/banner-coupon1.jpg') }}" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100"
                             src=" {{ asset('storage/images/dashboard/banner/banner-coupon2.jpg') }}"
                             alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100"
                             src="{{ asset('storage/images/dashboard/banner/banner-coupon3.jpg') }}" alt="Third slide">
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
                        <h2>@lang('List Of Coupon')</h2>
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
                            <div class="featured__item parent-featured__item">
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
                                    <hr class="fw-bold border-2 border-dark">
                                    <div class="featured__item__text">
                                        <h6>
                                            <a href="{{ route('frontend.dashboard.coupons.detail', ['slug' => $coupon->slug]) }}">{{ __($coupon->name) }}</a>
                                        </h6>
                                        <h5>  {{ $coupon->value}}{{$coupon->formatted_type_coupon}}</h5>
                                    </div>
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
                                <hr class="fw-bold border-2 border-dark">
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
    <script src="{{ asset('js/pages/filter.js') }}"></script>
@endpush
