@extends('frontend.layouts.app')

@section('title', __('RETURN ORDER'))

@section('content')
    <div class="fade-in">
        @include('includes.partials.messages')
    </div><!--fade-in-->

    <input type="hidden" class="sub-js" data-sub="{{ json_encode([
        'success' => __('Status update successful.'),
        'unsuccess' => __('An error occurred, please try again.'),
        'done5' => __('The order has been successfully delivered, so you cannot update')
    ]) }}">
    <div class="mt-4 rounded bg-white">
        <div class="p-3 pl-2 font-weight-bold text-center pb-5">
            <h3>
                @lang('RETURN ORDER')
            </h3>
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
                        @include('frontend.pages.orders.partials.show-modal-filter')
                    </form>
                </div>
            </div>
        </div>

        @include('frontend.pages.orders.partials.show-tag-filter')
        <div class="px-3 pb-3 pt-0">
            <div class="table-responsive rounded">
                <table class="table table-hover table-striped border rounded" id="categories-table">
                    <thead class="bg-header-table">
                    <tr>
                        <th class="text-center">@lang('No.')</th>
                        <th class="text-center">
                            @lang('Order Code')
                        </th>
                        <th class="text-center">
                            @lang('Order account name')
                        </th>
                        <th class="text-center">
                            @lang('Customer name')
                        </th>
                        <th class="text-center">
                            @lang('Payment method')
                        </th>
                        <th class="text-center">
                            @lang('Total price')
                        </th>
                        <th class="text-center">
                            @lang('Order status')
                        </th>
                        <th class="text-center">
                            @lang('Customer information')
                        </th>
                        <th class="text-center">
                            @lang('Product information')
                        </th>
                        @if (auth()->user()->isRoleCustomer())
                            <th class="text-center">
                                @lang('Action')
                            </th>
                        @endif
                        <th class="text-center">
                            @lang('Return order')
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration + $orders->firstItem() - 1 }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $order->code_order }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $order->created_by }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $order->customer_name }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $order->formatted_payment }}
                            </td>
                            <td class="text-center align-middle">
                                {{ formatMoney($order->total) }}
                            </td>
                            <td class="text-center align-middle" style="color:firebrick">
                                {{ $order->formatted_order_status }}
                            </td>
                            <td class="text-center align-middle">
                                <a href="{{ route('frontend.orders.customerInfo', ['orderId' => $order->id]) }}"><i
                                            class="fas fa-user"></i></a>
                            </td>
                            <td class="text-center align-middle">
                                <a href="{{ route('frontend.orders.productInfo', ['orderId' => $order->id]) }}"><i
                                            class="fas fa-info"></i></a>
                            </td>
                            {{--                            Action--}}
                            {{--                            Bên Admin có nút xác nhận nếu User Trả hàng--}}
                            {{--                            Bên Customer có nút trả hàng ở td cuối--}}
                            {{--                            Sau khi đc admin xác nhận thì hành động được hiển thị --}}
                            {{--                            Nếu chọn huỷ trả hàng thì ko đc trả lại, tắt các option và bên trả hàng in ra text--}}
                            <td class="text-center align-middle">
                                <select class="form-control status-order" style="width: 100%;" name="status"
                                        data-current-status="{{ $order->status }}"
                                        data-url="{{ route('frontend.orders.updateStatusOrder', ['orderId' => $order->id]) }}"
                                >
                                    {{--                                        data-sub="{{ json_encode([ád, sdhk]) }}"--}}
                                    @foreach (config('constants.status_return_order') as $key => $value)
                                        @if (config('constants.status_return_order.Order sent successfully') == $order->status)
                                            <option value="{{ $value }}"
                                                    @if ($order->status == $value) selected @endif>
                                                {{ __($key) }}
                                            </option>
                                            @break

                                        @elseif (config('constants.status_order_text.Successful delivery') == $order->status)
                                            <option
                                                    value="{{ config('constants.status_order_text.Successful delivery') }}"
                                                    @if ($order->status == config('constants.status_order_text.Successful delivery')) selected @endif>
                                                {{ __(array_search('5', config('constants.status_order_text'))) }}
                                            </option>
                                            @break

                                        @elseif($value == config('constants.status_order_text.Cancel order'))
                                            @continue
                                        @endif
                                        <option value="{{ $value }}"
                                                @if ($order->status == $value) selected @endif>
                                            {{ __($key) }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>

                            <td class="text-center align-middle">
{{--                                @if(auth()->user()->isRoleCustomer())--}}
{{--                                    <form action="{{ route('frontend.products.destroy', ['id' => $product->id]) }}"--}}
{{--                                          method="POST">--}}
{{--                                        @csrf--}}
{{--                                        @method('DELETE')--}}
{{--                                        <button type="button" class="btn btn-link"--}}
{{--                                                href="#modalDelete-{{ $product->id }}"--}}
{{--                                                class="trigger-btn" data-toggle="modal">--}}
{{--                                            <i class="fas fa-trash" style="color: #ff0000;"></i>--}}
{{--                                        </button>--}}
{{--                                        @include('frontend.pages.products.partials.show-modal-delete', [--}}
{{--                                            'productId' => $product->id,--}}
{{--                                        ])--}}
{{--                                    </form>--}}
{{--                                @endif--}}
                            </td>
                            {{--                            @if (auth()->user()->isRoleCustomer())--}}
                            {{--                                <td class="text-center align-middle" style="width: 200px;">--}}
                            {{--                                    <select class="form-control status-order" style="width: 100%;" name="status"--}}
                            {{--                                            data-current-status="{{ $order->status }}"--}}
                            {{--                                            data-url="{{ route('frontend.orders.updateStatusOrder', ['orderId' => $order->id]) }}">--}}
                            {{--                                        @foreach (config('constants.status_order_text') as $key => $value)--}}
                            {{--                                            @if (config('constants.status_order_text.Cancel order') == $order->status)--}}
                            {{--                                                <option value="{{ $value }}"--}}
                            {{--                                                        @if ($order->status == $value) selected @endif>--}}
                            {{--                                                    {{ __($key) }}--}}
                            {{--                                                </option>--}}
                            {{--                                                @break--}}

                            {{--                                            @elseif (config('constants.status_order_text.Successful delivery') == $order->status)--}}
                            {{--                                                <option--}}
                            {{--                                                        value="{{ config('constants.status_order_text.Successful delivery') }}"--}}
                            {{--                                                        @if ($order->status == config('constants.status_order_text.Successful delivery')) selected @endif>--}}
                            {{--                                                    {{ __(array_search('5', config('constants.status_order_text'))) }}--}}
                            {{--                                                </option>--}}
                            {{--                                                @break--}}

                            {{--                                            @elseif($value == config('constants.status_order_text.Cancel order'))--}}
                            {{--                                                @continue--}}
                            {{--                                            @endif--}}
                            {{--                                            <option value="{{ $value }}"--}}
                            {{--                                                    @if ($order->status == $value) selected @endif>--}}
                            {{--                                                {{ __($key) }}--}}
                            {{--                                            </option>--}}
                            {{--                                        @endforeach--}}
                            {{--                                    </select>--}}
                            {{--                                </td>--}}
                            {{--                            @endif--}}
                            {{--                            @if (auth()->user()->isRoleCustomer())--}}
                            {{--                                <td class="text-center align-middle">--}}
                            {{--                                    @if ($order->status == config('constants.status_order.ready_to_pick'))--}}
                            {{--                                        <form--}}
                            {{--                                                action="{{ route('frontend.orders.cancelOrder', ['orderId' => $order->id]) }}"--}}
                            {{--                                                method="POST">--}}
                            {{--                                            @csrf--}}
                            {{--                                            @method('PATCH')--}}
                            {{--                                            <button type="button" class="btn btn-link"--}}
                            {{--                                                    href="#modalCancelOrder-{{ $order->id }}" class="trigger-btn"--}}
                            {{--                                                    data-toggle="modal">--}}
                            {{--                                                <i class="fas fa-times" style="color: #df2b0c;" disabled></i>--}}
                            {{--                                            </button>--}}
                            {{--                                            @include('frontend.pages.orders.partials.modal-cancel-order', [--}}
                            {{--                                                'orderId' => $order->id,--}}
                            {{--                                            ])--}}
                            {{--                                        </form>--}}
                            {{--                                    @elseif($order->status == config('constants.status_order.cancel'))--}}
                            {{--                                        @lang('Order has been cancelled')--}}
                            {{--                                    @elseif($order->status == config('constants.status_order.delivered'))--}}
                            {{--                                        @lang('The order has been successfully delivered, so it cannot be canceled.')--}}
                            {{--                                    @else--}}
                            {{--                                        @lang('You cannot cancel your order because it has already been prepared and shipped')--}}
                            {{--                                    @endif--}}
                            {{--                                </td>--}}
                            {{--                            @else--}}
                            {{--                                <td class="text-center align-middle">--}}
                            {{--                                    @if (--}}
                            {{--                                        $order->status != config('constants.status_order.cancel') &&--}}
                            {{--                                            $order->status != config('constants.status_order.delivered'))--}}
                            {{--                                        <form--}}
                            {{--                                                action="{{ route('frontend.orders.cancelOrder', ['orderId' => $order->id]) }}"--}}
                            {{--                                                method="POST">--}}
                            {{--                                            @csrf--}}
                            {{--                                            @method('PATCH')--}}
                            {{--                                            <button type="button" class="btn btn-link"--}}
                            {{--                                                    href="#modalCancelOrder-{{ $order->id }}" class="trigger-btn"--}}
                            {{--                                                    data-toggle="modal">--}}
                            {{--                                                <i class="fas fa-times" style="color: #df2b0c;" disabled></i>--}}
                            {{--                                            </button>--}}
                            {{--                                            @include('frontend.pages.orders.partials.modal-cancel-order', [--}}
                            {{--                                                'orderId' => $order->id,--}}
                            {{--                                            ])--}}
                            {{--                                        </form>--}}
                            {{--                                    @elseif($order->status == config('constants.status_order.delivered'))--}}
                            {{--                                        @lang('The order has been successfully delivered, so it cannot be canceled.')--}}
                            {{--                                    @else--}}
                            {{--                                        @lang('Order has been cancelled.')--}}
                            {{--                                    @endif--}}
                            {{--                                </td>--}}
                            {{--                            @endif--}}
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center">@lang('Not found data')</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="pagination container-fluid pt-2 position-sticky">
                {{ $orders->onEachSide(1)->appends(request()->only('search', 'status', 'payment_method'))->links('frontend.includes.custom-pagination') }}
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script src="{{ asset('js/pages/filter.js') }}"></script>
    <script src="{{ asset('js/pages/order/updateStatus.js') }}"></script>
@endpush
