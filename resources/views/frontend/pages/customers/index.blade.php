@extends('frontend.layouts.app')

@section('title', __('CUSTOMER MANAGEMENT'))

@section('content')
    <div class="fade-in">
        @include('includes.partials.messages')
    </div><!--fade-in-->
    <div class="mt-4 rounded bg-white">
        <div class="p-3 pl-2 font-weight-bold text-center pb-5">
            <h3>
                @lang('CUSTOMER MANAGEMENT')
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
                <a class="btn-footer-modal btn btn-primary rounded-10 ml-3"
                   href="{{ route('frontend.customers.create') }}">@lang('Create New Customer')</a>
                <a class="btn-footer-modal btn btn-warning rounded-10 ml-3"
                   href="{{ route('frontend.customers.trash') }}">@lang('Customer Archive')
                </a>
            </div>
        </div>
        <div class="px-3 pb-3 pt-0">
            <div class="table-responsive rounded">
                <table class="table table-hover table-striped border rounded" id="categories-table">
                    <thead class="bg-header-table">
                    <tr>
                        <th class="text-center">@lang('No.')</th>
                        <th class="text-center">
                            @lang('Name')
                        </th>
                        <th class="text-center">
                            @lang('Email')
                        </th>
                        <th class="text-center">
                            @lang('Created Date')
                        </th>
                        <th class="text-center">
                            @lang('Update')
                        </th>
                        <th class="text-center">
                            @lang('Delete')
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($customers as $customer)
                        <tr>
                            <td class="text-center align-middle">
                                {{ $loop->iteration + $customers->firstItem() - 1 }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $customer->name }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $customer->email }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $customer->formatted_created_at ?? __('unclear') }}
                            </td>
                            <td class="text-center align-middle">
                                <a href="{{ route('frontend.customers.edit', ['id' => $customer->id]) }}">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </td>
                            <td class="text-center align-middle">
                                <form action="{{ route('frontend.customers.destroy', ['id' => $customer->id]) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-link" href="#modalDelete-{{ $customer->id }}"
                                            data-toggle="modal">
                                        <i class="fas fa-trash" style="color: #ff0000;"></i>
                                    </button>
                                    @include('frontend.pages.customers.partials.show-modal-delete', [
                                        'customerId' => $customer->id,
                                    ])
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">@lang('Not found data')</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="pagination container-fluid pt-2 position-sticky">
                {{ $customers->onEachSide(1)->appends(request()->only('search'))->links('frontend.includes.custom-pagination') }}
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script src="{{ asset('js/pages/filter.js') }}"></script>
@endpush