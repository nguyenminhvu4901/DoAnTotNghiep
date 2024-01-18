@extends('frontend.layouts.app')

@section('title', __('PRODUCT IMAGE MANAGEMENT IN TRASH'))

@section('content')
    <div class="fade-in">
        @include('includes.partials.messages')
    </div><!--fade-in-->
    <div class="mt-4 rounded bg-white">
        <div class="p-3 pl-2 font-weight-bold text-center pb-5">
            <h3>
                @lang('PRODUCT IMAGE MANAGEMENT IN TRASH')
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
                        @include('frontend.pages.product-detail.partials.show-modal-filter')
                    </form>
                </div>
            </div>
        </div>
        @include('frontend.pages.product-detail.partials.show-tag-filter')
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
                                @lang('Category')
                            </th>
                            <th class="text-center">
                                @lang('Name Image')
                            </th>
                            <th class="text-center">
                                @lang('Image')
                            </th>
                            <th class="text-center">
                                @lang('Order Image')
                            </th>
                            <th class="text-center">
                                @lang('Restore')
                            </th>
                            <th class="text-center">
                                @lang('Delete')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($productImages as $productImage)
                            <tr>
                                <td class="text-center align-middle">
                                    {{ $loop->iteration + $productImages->firstItem() - 1 }}
                                </td>
                                <td class="text-center align-middle">
                                    {{ $productImage->product->name }}
                                </td>
                                <td class="text-center align-middle">
                                    {{ optional($productImage->categories())->first()->name ?? __('There are no categories') }}
                                </td>
                                <td class="text-center align-middle">
                                    {{ $productImage->name }}
                                </td>
                                <td class="text-center align-middle">
                                    <img src="{{ $productImage->getImageUrlAttribute() }}" alt="" width="100px">
                                </td>
                                <td class="text-center align-middle">
                                    {{ $productImage->order }}
                                </td>
                                <td class="text-center align-middle">
                                    <form
                                        action="{{ route('frontend.productImages.restore', ['id' => $productImage->id]) }}"
                                        method="GET">
                                        @csrf
                                        <button type="button" class="btn btn-link"
                                            href="#modalRestore-{{ $productImage->id }}" class="trigger-btn"
                                            data-toggle="modal">
                                            <i class="fas fa-trash-restore"></i>
                                        </button>
                                        @include(
                                            'frontend.pages.product-image.partials.show-modal-restore',
                                            ['productImageId' => $productImage->id]
                                        )
                                    </form>
                                </td>
                                <td class="text-center align-middle">
                                    <form
                                        action="{{ route('frontend.productImages.forceDelete', ['id' => $productImage->id]) }}">
                                        @csrf
                                        <button type="button" class="btn btn-link"
                                            href="#modalDelete-{{ $productImage->id }}" class="trigger-btn"
                                            data-toggle="modal">
                                            <i class="fas fa-trash" style="color: #ff0000;"></i>
                                        </button>
                                        @include(
                                            'frontend.pages.product-image.partials.show-modal-delete',
                                            ['productImageId' => $productImage->id]
                                        )
                                    </form>
                                </td>
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
                {{ $productImages->onEachSide(1)->appends(request()->only('search', 'categories', 'products'))->links('frontend.includes.custom-pagination') }}
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script src="{{ asset('js/pages/filter.js') }}"></script>
@endpush
