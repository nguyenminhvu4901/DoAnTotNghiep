<div class="row featured__filter">
    @forelse($products as $product)
        <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
            <div class="featured__item">
                <div class="featured__item__pic set-bg"
                     data-setbg="{{ isset($product->productImages) && !$product->productImages->isEmpty()
                                                ? $product->productImages->first()->getImageUrlAttribute()
                                                : asset('storage/images/products/default/ProductImageDefault.jpg') }}"
                     style="background-image: url({{ isset($product->productImages) && !$product->productImages->isEmpty()
                                                ? $product->productImages->first()->getImageUrlAttribute()
                                                : asset('storage/images/products/default/ProductImageDefault.jpg') }})">
                    <ul class="featured__item__pic__hover">
                        {{--                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>--}}
                        <li><a href="{{ route('frontend.products.detail', ['id' => $product->id]) }}"><i
                                        class="fa fa-info-circle"></i></a></li>
                        {{--                                    <li><a href="{{ route('frontend.products.detail', ['id' => $product->id]) }}"><i class="fa fa-shopping-cart"></i></a></li>--}}
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
                     style="background-image: url({{asset('storage/images/products/default/ProductImageDefault.jpg') }})">
                    <ul class="featured__item__pic__hover">
                        {{--                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>--}}
                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                        {{--                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>--}}
                    </ul>
                </div>
                <div class="featured__item__text">
                    <h6><a href="#">@lang('There are currently no products for sale')</a></h6>
                    <h5> {{ __('N/A') }}</h5>
                </div>
            </div>
        </div>
    @endforelse
</div>
<div class="pagination container-fluid pt-2 position-sticky">
    {{ $products->onEachSide(1)->appends(request()->only('search', 'categories', 'products'))->links('frontend.includes.custom-pagination') }}
</div>