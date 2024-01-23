@extends('frontend.layouts.app')

@section('title', __('Cart'))

@section('content')
    <div class="fade-in">
        @include('includes.partials.messages')
    </div>
    <!-- Checkout Section Begin -->
    <section class="">
        <div class="container-fluid">
            <div class="checkout__form">
                <h4>@lang('Billing Details')</h4>
                <form action="{{ route('frontend.orders.processCheckout') }}" method="POST" id="form-checkout">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-lg-9 col-md-9">
                            <table class="table table-hover table-striped border rounded" id="categories-table">
                                <thead class="bg-header-table">
                                    <tr>
                                        <th class="text-center">@lang('No.')</th>
                                        <th class="text-center">
                                            @lang('Product name')
                                        </th>
                                        <th class="text-center">
                                            @lang('Product quantity')
                                        </th>
                                        <th class="text-center">
                                            @lang('Product size')
                                        </th>
                                        <th class="text-center">
                                            @lang('Product color')
                                        </th>
                                        <th class="text-center">
                                            @lang('Product price')
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @forelse($order->productOrder as $product)
                                            <td class="text-center align-middle">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="text-center align-middle">
                                                <a
                                                    href="{{ route('frontend.products.detail', ['id' => $product->product_id]) }}">
                                                    {{ $product->product->name }}
                                                </a>
                                            </td>
                                            <td class="text-center align-middle">
                                                {{ $product->product_quantity }}
                                            </td>
                                            <td class="text-center align-middle">
                                                {{ $product->product_size }}
                                            </td>
                                            <td class="text-center align-middle">
                                                {{ $product->product_color }}
                                            </td>
                                            <td class="text-center align-middle">
                                                {{ formatMoney($product->product_price) }}
                                            </td>
                                    </tr>
                                @empty
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div class="checkout__order">
                                <h4>@lang('Your Order')</h4>
                                <div class="checkout__order__total">@lang('Subtotal')<span
                                        style="color:black">{{ formatMoney($order->sub_total) }}</span>
                                </div>
                                @if ($order->coupons->isNotEmpty())
                                    <div class="checkout__order__total">@lang('Coupon') <span
                                            style="color:black">{{ $order->coupons->first()->name }}
                                            ({{ $order->coupons->first()->value }}{{ $order->coupons->first()->type == config('constants.coupon.percent') ? '%' : 'đ' }})</span>
                                    </div>
                                @endif
                                <div class="checkout__order__total">@lang('Ship')
                                    <span style="color:black">{{ formatMoney($order->ship) }}</span>
                                </div>
                                <div class="checkout__order__total">@lang('Total')
                                    <span>{{ formatMoney($order->total) }}</span>
                                </div>
                            </div>
                            <br>
                            <div class="col-lg-12">
                                <div class="checkout__input">
                                    <p>@lang('Payment method')</p>
                                    <input type="text" class="form-control" value="{{ $order->formatted_payment }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="checkout__input">
                                    <p>@lang('Note')</p>
                                    <textarea cols="10" rows="5" disabled class="form-control rounded">
                                        {{ strip_tags($order->note) }}
                                    </textarea>
                                </div>
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
