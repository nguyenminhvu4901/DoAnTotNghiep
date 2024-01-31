@extends('frontend.layouts.app')

@section('title', __('SALE MANAGEMENT'))

@section('content')
    <div class="fade-in">
        @include('includes.partials.messages')
    </div><!--fade-in-->
    <input type="hidden" class="sub-js" data-sub="{{ json_encode([
        'success' => __('Status update successful.'),
        'unsuccess' => __('An error occurred, please try again.')
    ]) }}">
    <div class="mt-4 rounded bg-white">
        <div class="p-3 pl-2 font-weight-bold text-center pb-5">
            <h3>
                @lang('SALE MANAGEMENT')
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
                        @include('frontend.pages.sales.partials.show-modal-filter')
                    </form>
                </div>
            </div>
        </div>
        @include('frontend.pages.sales.partials.show-tag-filter')
        <div class="px-3 pb-3 pt-0">
            <div class="table-responsive rounded">
                <table class="table table-hover table-striped border rounded" id="categories-table">
                    <thead class="bg-header-table">
                    <tr>
                        <th class="text-center">@lang('No.')</th>
                        <th class="text-center">
                            @lang('Product')
                        </th>
                        <th class="text-center">
                            @lang('Value')
                        </th>
                        <th class="text-center">
                            @lang('Start Date')
                        </th>
                        <th class="text-center">
                            @lang('Expiry Date')
                        </th>
                        <th class="text-center">
                            @lang('Remain')
                        </th>
                        @hasPermission('user.sale.edit')
                        <th class="text-center">
                            @lang('Update')
                        </th>
                        @endhasPermission
                        @hasPermission('user.sale.delete')
                        <th class="text-center">
                            @lang('Delete')
                        </th>
                        @endhasPermission
                        @hasPermission('user.sale.edit')
                        <th class="text-center">
                            @lang('Active')
                        </th>
                        @endhasPermission
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($sales as $sale)
                        <tr>
                            <td class="text-center align-middle">
                                {{ $loop->iteration + $sales->firstItem() - 1 }}
                            </td>
                            <td class="text-center align-middle">
                                {{     (isset($sale->category) && $sale->category->first() != null) ? $sale->category->first()->name :
                                    ($sale->product->first() == null && $sale->productThroghProductDetail->first() == null
                                    ? __('No Product Sale')
                                    : ($sale->productThroghProductDetail->first() == null
                                        ? $sale->product->first()->name . ' (' . __('All Products') . ')'
                                        : $sale->productThroghProductDetail->first()->name .
                                            ' (' .
                                            $sale->productDetail->first()->size .
                                            ', ' .
                                            $sale->productDetail->first()->color .
                                            ')')) }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $sale->value }} {{ $sale->formatted_type_sale }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $sale->formatted_start_date_at }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $sale->formatted_expiry_date_at }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $sale->remain }}
                            </td>
                            @hasPermission('user.sale.edit')
                            <td class="text-center align-middle">
                                <a href="{{ route('frontend.sales.edit', ['id' => $sale->id]) }}">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </td>
                            @endhasPermission
                            @hasPermission('user.sale.delete')
                            <td class="text-center align-middle">
                                <form action="{{ route('frontend.sales.destroy', ['saleId' => $sale->id]) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-link" href="#modalDelete-{{ $sale->id }}"
                                            class="trigger-btn" data-toggle="modal">
                                        <i class="fas fa-trash" style="color: #ff0000;"></i>
                                    </button>
                                    @include('frontend.pages.sales.partials.show-model-delete', [
                                        'saleId' => $sale->id,
                                    ])
                                </form>
                            </td>
                            @endhasPermission
                            @hasPermission('user.sale.edit')
                            <td class="text-center align-middle">
                                <label class="switch">
                                    <input class="is-active-sale"
                                           data-url="{{ route('frontend.sales.updateActive', ['saleId' => $sale->id]) }}"
                                           type="checkbox" name="is_active" value="{{ $sale->is_active }}"
                                            {{ $sale->is_active == 1 ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            @endhasPermission
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">@lang('Not found data')</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="pagination container-fluid pt-2 position-sticky">
                {{ $sales->onEachSide(1)->appends(request()->only('search', 'products', 'categories', 'colors', 'sizes', 'order_by'))->links('frontend.includes.custom-pagination') }}
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script src="{{ asset('js/pages/filter.js') }}"></script>
    <script src="{{ asset('js/pages/sale/update-active.js') }}"></script>
@endpush
