@extends('frontend.layouts.app')

@section('title', __('RETURN ORDER'))

@section('content')
    <div class="fade-in">
        @include('includes.partials.messages')
    </div><!--fade-in-->

    <input type="hidden" class="sub-js" data-sub="{{ json_encode([
        'success' => __('Status update successful.'),
        'unsuccess' => __('An error occurred, please try again.'),
        'done5' => __('The order has been returned successfully so you cannot update it.')
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
            <div class="d-flex align-items-center justify-content-md-end">
                <a class="btn-footer-modal btn btn-primary rounded-10"
                   href="{{ route('frontend.orders.index') }}">@lang('Order')</a>
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
                        <th class="text-center">
                            @lang('Action')
                        </th>
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
                                @if (config('constants.status_return_order.Successful delivery') == $order->status_return_order &&
                                    $order->is_return_order == 0)
                                    {{ $order->formatted_order_status }}
                                @elseif(config('constants.status_return_order.Successful delivery') == $order->status_return_order &&
                                    $order->is_return_order == 1)
                                    @lang('Wait for the shop to confirm.')
                                @elseif(config('constants.status_return_order.Successful delivery') == $order->status_return_order &&
                               $order->is_return_order == 2)
                                    @lang('This order cannot be returned.')
                                @else
                                    {{ $order->formatted_return_order_status }}
                                @endif
                            </td>
                            <td class="text-center align-middle">
                                <a href="{{ route('frontend.orders.customerInfo', ['orderId' => $order->id]) }}"><i
                                            class="fas fa-user"></i></a>
                            </td>
                            <td class="text-center align-middle">
                                <a href="{{ route('frontend.orders.productInfo', ['orderId' => $order->id]) }}"><i
                                            class="fas fa-info"></i></a>
                            </td>
                            <td class="text-center align-middle">
                                <select class="form-control status-return-order" style="width: 100%;" name="status"
                                        data-current-status="{{ $order->status_return_order }}"
                                        data-url="{{ route('frontend.orders.updateStatusReturnOrder', ['orderId' => $order->id]) }}">
                                    @if (config('constants.status_return_order.Successful delivery') == $order->status_return_order)
                                        <option value="{{ $order->status_return_order }}" selected>
                                            {{ __('Successful delivery') }}
                                        </option>
                                    @else
                                        @if(auth()->user()->isRoleCustomer())
                                            @foreach (config('constants.status_return_order') as $key => $value)
                                                @if (config('constants.status_return_order.Cancel return order') == $order->status_return_order)
                                                    <option value="{{ $value }}"
                                                            @if ($order->status_return_order == $value) selected @endif>
                                                        {{ __($key) }}
                                                    </option>
                                                    @break
                                                @endif

                                                @if ($value == config('constants.status_return_order.Successful delivery'))
                                                    @continue
                                                @endif

                                                <option value="{{ $value }}"
                                                        @if (in_array($value, [config('constants.status_return_order.Shop has received the goods'), config('constants.status_return_order.Refund successful'), config('constants.status_return_order.Shipped')]) ||
                                                        config('constants.status_return_order.Shipped') != $value && config('constants.status_return_order.Shipped') == $order->status_return_order ||
                                                        config('constants.status_return_order.Shop has received the goods') == $order->status_return_order ||
                                                        config('constants.status_return_order.Refund successful') == $order->status_return_order)
                                                            disabled
                                                        @endif

                                                        @if ($order->status_return_order == $value)
                                                            selected
                                                        @endif
                                                >
                                                    {{ __($key) }}
                                                </option>
                                            @endforeach

                                            {{--                                            Admin--}}
                                        @else
                                            @foreach (config('constants.status_return_order') as $key => $value)

                                                @if (config('constants.status_return_order.Cancel return order') == $order->status_return_order)
                                                    <option value="{{ $value }}"
                                                            @if ($order->status_return_order == $value) selected @endif>
                                                        {{ __($key) }}
                                                    </option>
                                                    @break
                                                @endif

                                                @if(config('constants.status_return_order.Successful delivery') == $value)
                                                    @continue
                                                @endif
                                                <option value="{{ $value }}"
                                                        @if (in_array($value, [config('constants.status_return_order.Preparing orders')]) ||
                                                            config('constants.status_return_order.Refund successful') == $order->status_return_order
                                                             )
                                                            disabled
                                                        @endif
                                                        @if ($order->status_return_order == $value) selected @endif>
                                                    {{ __($key) }}
                                                </option>
                                            @endforeach

                                        @endif
                                    @endif
                                </select>
                            </td>

                            <td class="text-center align-middle">
                                @if(auth()->user()->isRoleCustomer())
                                    @if (config('constants.status_return_order.Successful delivery') == $order->status_return_order
                                       && $order->is_return_order == 0)
                                        <form id="sendRequestReturnOrder"
                                              data-url="{{ route('frontend.orders.returnOrderInCustomer', ['orderId' => $order->id]) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="button" class="btn btn-link" data-toggle="modal"
                                                    data-target="#modalReturnOrderInCustomer-{{ $order->id }}">
                                                <i class="fas fa-exchange-alt" style="color: #33df0c;" disabled></i>
                                            </button>
                                            @include('frontend.pages.orders.return-order.partials.return-order-in-customer', [
                                                'orderId' => $order->id,
                                            ])
                                        </form>
                                    @elseif(config('constants.status_return_order.Successful delivery') == $order->status_return_order
                                       && $order->is_return_order == 1)
                                        @lang('Wait for the shop to confirm.')
                                    @elseif(config('constants.status_return_order.Successful delivery') == $order->status_return_order
                                  && $order->is_return_order == 2)
                                        @lang('Your return request was not approved!')
                                    @elseif(config('constants.status_return_order.Preparing orders') == $order->status_return_order
                             && $order->is_return_order == 1)
                                        @lang('Your return request has been approved!')
                                    @elseif($order->status_return_order == !config('constants.status_return_order.Preparing orders'))
                                        @lang('You cannot cancel return your order.')
                                    @elseif($order->status_return_order == config('constants.status_return_order.Refund successful'))
                                        @lang('Complete the return order process.')
                                    @else
                                        <p style="color: #7ece07;
                                        ">@lang('Order returns are being processed.')</p>
                                    @endif
                                @else
                                    @if (config('constants.status_return_order.Successful delivery') == $order->status_return_order
                                      && $order->is_return_order == 1)
                                        <form
                                                id="confirmRequestReturnOrder"
                                                data-url="{{ route('frontend.orders.returnOrderConfirmation', ['orderId' => $order->id]) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="button" class="btn btn-link"
                                                    href="#modalreturnOrderConfirmation-{{ $order->id }}"
                                                    data-toggle="modal">
                                                <i class="fas fa-check" style="color: #33df0c;" disabled></i>
                                            </button>
                                            @include('frontend.pages.orders.return-order.partials.return-order-confirm', [
                                                'orderId' => $order->id,
                                            ])
                                        </form>

                                        <form
                                                id="noConfirmRequestReturnOrder"
                                                data-url="{{ route('frontend.orders.noReturnOrderConfirmation', ['orderId' => $order->id]) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="button" class="btn btn-link"
                                                    href="#modalnoReturnOrderConfirmation-{{ $order->id }}"
                                                    class="trigger-btn"
                                                    data-toggle="modal">
                                                <i class="fas fa-times" style="color: #df0c0c;" disabled></i>
                                            </button>
                                            @include('frontend.pages.orders.return-order.partials.no-return-order-confirm', [
                                                'orderId' => $order->id,
                                            ])
                                        </form>
                                    @elseif($order->status_return_order == config('constants.status_return_order.Refund successful'))
                                        @lang('Complete the return order process.')
                                    @elseif(config('constants.status_return_order.Cancel return order') == $order->status_return_order)
                                        <p style="color: red">@lang('This order cannot be returned.')</p>
                                    @elseif(config('constants.status_return_order.Successful delivery') == $order->status_return_order
                                      && $order->is_return_order == 0)
                                        @lang('There are no requests to return orders.')
                                    @elseif(config('constants.status_return_order.Successful delivery') == $order->status_return_order
                                      && $order->is_return_order == 2)
                                        <p style="color: red">@lang('This order cannot be returned.')</p>
                                    @else
                                        <p style="color: #7fcb06;
                                        ">@lang('Order returns are being processed.')</p>
                                    @endif
                                @endif
                            </td>
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
    <script src="{{ asset('js/pages/order/sendRequestReturnOrder.js') }}"></script>
@endpush
