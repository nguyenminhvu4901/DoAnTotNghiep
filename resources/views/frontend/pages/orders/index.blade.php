@extends('frontend.layouts.app')

@section('title', __('ORDER'))

@section('content')
    <div class="fade-in">
        @include('includes.partials.messages')
    </div><!--fade-in-->
    <div class="mt-4 rounded bg-white">
        <div class="p-3 pl-2 font-weight-bold text-center pb-5">
            <h3>
                @lang('ORDER')
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
                        {{-- @include('frontend.pages.products.partials.show-modal-filter') --}}
                    </form>
                </div>
            </div>
        </div>
        {{-- @include('frontend.pages.products.partials.show-tag-filter') --}}
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
                                @lang('Ship')
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
                                    {{ formatMoney($order->ship) }}
                                </td>
                                <td class="text-center align-middle">
                                    {{ $order->formatted_payment }}
                                </td>
                                <td class="text-center align-middle">
                                    {{ formatMoney($order->total) }}
                                </td>
                                <td class="text-center align-middle">
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
                                <td class="text-center align-middle">
                                    @if (auth()->user()->isAdmin() ||
                                            auth()->user()->isRoleStaff())
                                        <select class="form-control w-100 filter-select">
                                            <option value="default">@lang('Choose Ward')</option>
                                        </select>
                                    @else
                                        <a href=""><button type="button" class="btn btn-button"><i
                                                    class="fas fa-times" style="color: #df2b0c;"></i></button></a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">@lang('Not found data')</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="pagination container-fluid pt-2 position-sticky">
                {{ $orders->onEachSide(1)->appends(request()->only('search'))->links('frontend.includes.custom-pagination') }}
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script src="{{ asset('js/pages/filter.js') }}"></script>
@endpush
