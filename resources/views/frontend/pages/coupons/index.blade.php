@extends('frontend.layouts.app')

@section('title', __('COUPON MANAGEMENT'))

@section('content')
    <div class="fade-in">
        @include('includes.partials.messages')
    </div><!--fade-in-->
    <input type="hidden" class="sub-js" data-sub="{{ json_encode([
        'success' => __('Update successful.'),
        'unsuccess' => __('An error occurred, please try again.')
    ]) }}">
    <div class="mt-4 rounded bg-white">
        <div class="p-3 pl-2 font-weight-bold text-center pb-5">
            <h3>
                @lang('COUPON MANAGEMENT')
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
                    </form>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-md-end">
                @hasPermission('user.coupon.create')
                <a class="btn-footer-modal btn btn-primary rounded-10"
                   href="{{ route('frontend.coupons.create') }}">@lang('Create New Coupon')
                </a>
                @endhasPermission
            </div>
        </div>
        <div class="px-3 pb-3 pt-0">
            <div class="table-responsive rounded">
                <table class="table table-hover table-striped border rounded" id="categories-table">
                    <thead class="bg-header-table">
                    <tr>
                        <th class="text-center">
                            @lang('No.')
                        </th>
                        <th class="text-center">
                            @lang('Coupon')
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
                        <th class="text-center">
                            @lang('Quantity')
                        </th>
                        <th class="text-center">
                            @lang('Detail')
                        </th>
                        @hasPermission('user.coupon.edit')
                        <th class="text-center">
                            @lang('Update')
                        </th>
                        @endhasPermission
                        @hasPermission('user.coupon.disable')
                        <th class="text-center">
                            @lang('Delete')
                        </th>
                        @endhasPermission
                        @hasPermission('user.coupon.edit')
                        <th class="text-center">
                            @lang('Active')
                        </th>
                        @endhasPermission
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($coupons as $coupon)
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration + $coupons->firstItem() - 1 }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $coupon->name }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $coupon->value }} {{ $coupon->formatted_type_coupon }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $coupon->formatted_start_date_at }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $coupon->formatted_expiry_date_at }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $coupon->remain }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $coupon->quantity }}
                            </td>
                            <td class="text-center align-middle">
                                <a href="{{ route('frontend.coupons.detail', ['slug' => $coupon->slug]) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                            @hasPermission('user.coupon.edit')
                            <td class="text-center align-middle">
                                <a href="{{ route('frontend.coupons.edit', ['slug' => $coupon->slug]) }}">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </td>
                            @endhasPermission
                            @hasPermission('user.coupon.disable')
                            <td class="text-center align-middle">
                                <form action="{{ route('frontend.coupons.destroy', ['slug' => $coupon->slug]) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-link" href="#modalDelete-{{ $coupon->id }}"
                                            class="trigger-btn" data-toggle="modal">
                                        <i class="fas fa-trash" style="color: #ff0000;"></i>
                                    </button>
                                    @include('frontend.pages.coupons.partials.show-modal-delete', [
                                        'couponId' => $coupon->id,
                                    ])
                                </form>
                            </td>
                            @endhasPermission
                            @hasPermission('user.coupon.edit')
                            <td class="text-center align-middle">
                                <label class="switch">
                                    <input class="is-active-coupon"
                                           data-url="{{ route('frontend.coupons.updateActive', ['couponId' => $coupon->id]) }}"
                                           type="checkbox" name="is_active" value="{{ $coupon->is_active }}"
                                            {{ $coupon->is_active == 1 ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            @endhasPermission
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
                {{ $coupons->onEachSide(1)->appends(request()->only('search'))->links('frontend.includes.custom-pagination') }}
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script src="{{ asset('js/pages/filter.js') }}"></script>
    <script src="{{ asset('js/pages/coupon/update-active.js') }}"></script>
@endpush
