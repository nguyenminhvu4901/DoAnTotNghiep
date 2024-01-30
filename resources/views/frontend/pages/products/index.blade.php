@extends('frontend.layouts.app')

@section('title', __('PRODUCT MANAGEMENT'))

@section('content')
    <div class="fade-in">
        @include('includes.partials.messages')
    </div><!--fade-in-->
    <div class="mt-4 rounded bg-white">
        <div class="p-3 pl-2 font-weight-bold text-center pb-5">
            <h3>
                @lang('PRODUCT MANAGEMENT')
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
                        @include('frontend.pages.products.partials.show-modal-filter')
                    </form>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-md-end">
                @hasPermission('user.product.create')
                <a class="btn-footer-modal btn btn-primary rounded-10"
                   href="{{ route('frontend.products.create') }}">@lang('Create New Product')</a>
                @endhasPermission
                @hasPermission('user.product.trash')
                <a class="btn-footer-modal btn btn-warning rounded-10 ml-3"
                   href="{{ route('frontend.products.trash') }}">@lang('Product Archive')</a>
                @endhasPermission
            </div>
        </div>
        @include('frontend.pages.products.partials.show-tag-filter')
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
                            @lang('Sale price')
                        </th>
                        <th class="text-center">
                            @lang('Created by')
                        </th>
                        <th class="text-center">
                            @lang('Created date')
                        </th>
                        @hasPermission('user.product.create')
                        <th class="text-center">
                            @lang('Add Option Product')
                        </th>
                        @endhasPermission
                        @hasPermission('user.sale')
                        <th class="text-center">
                            @lang('Discount')
                        </th>
                        @endhasPermission
                        @hasPermission('user.product.create')
                        <th class="text-center">
                            @lang('Add Image')
                        </th>
                        @endhasPermission
                        <th class="text-center">
                            @lang('Product Information')
                        </th>
                        @hasPermission('user.product.edit')
                        <th class="text-center">
                            @lang('Update')
                        </th>
                        @endhasPermission
                        @hasPermission('user.product.delete')
                        <th class="text-center">
                            @lang('Delete')
                        </th>
                        @endhasPermission
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration + $products->firstItem() - 1 }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $product->name }}
                            </td>
                            <td class="text-center align-middle">
                                {{ optional($product->categories()->pluck('name'))->first() ?? __('There are no categories') }}
                            </td>
                            <td class="text-center align-middle">
                                @if (!$product->saleGlobal->isEmpty())
                                    {{ $product->saleGlobal->first()->value }}
                                    {{ $product->saleGlobal->first()->type == 1 ? __('VND') : '%' }}
                                @else
                                    @lang('There are no sale price')
                                @endif
                            </td>
                            <td class="text-center align-middle">
                                {{ $product->created_by ?? __('There is no creator') }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $product->formatted_created_at }}
                            </td>
                            @hasPermission('user.product.create')
                            <td class="text-center align-middle">
                                <a href="{{ route('frontend.productDetails.create', ['slug' => $product->slug]) }}">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </td>
                            @endhasPermission
                            @hasPermission('user.sale')
                            <td class="text-center align-middle">
                                @if ($product->saleGlobal->isEmpty())
                                    <a
                                            href="{{ route('frontend.sales.create', ['productId' => $product->id, 'level' => 'parent']) }}">
                                        <i class="fas fa-tag"></i> @lang('Add')
                                    </a>
                                @elseif(!$product->saleGlobal->isEmpty() && isset($product->sale->first()->id))
                                    <a
                                            href="{{ route('frontend.sales.edit', ['id' => $product->sale->first()->id, 'level' => 'parent']) }}">
                                        <i class="fas fa-edit"></i> @lang('Update')
                                    </a>
                                @else
                                    @lang('Product price has been reduced')
                                @endif
                            </td>
                            @endhasPermission
                            @hasPermission('user.product.create')
                            <td class="text-center align-middle">
                                <a href="{{ route('frontend.productImages.create', ['slug' => $product->slug]) }}">
                                    <i class="far fa-image"></i>
                                </a>
                            </td>
                            @endhasPermission
                            <td class="text-center align-middle">
                                <a href="{{ route('frontend.products.detail', ['id' => $product->id]) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                            @hasPermission('user.product.edit')
                            <td class="text-center align-middle">
                                <a href="{{ route('frontend.products.edit', ['slug' => $product->slug]) }}">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </td>
                            @endhasPermission
                            @hasPermission('user.product.delete')
                            <td class="text-center align-middle">
                                <form action="{{ route('frontend.products.destroy', ['id' => $product->id]) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-link" href="#modalDelete-{{ $product->id }}"
                                            class="trigger-btn" data-toggle="modal">
                                        <i class="fas fa-trash" style="color: #ff0000;"></i>
                                    </button>
                                    @include('frontend.pages.products.partials.show-modal-delete', [
                                        'productId' => $product->id,
                                    ])
                                </form>
                            </td>
                            @endhasPermission
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
                {{ $products->onEachSide(1)->appends(request()->only('search', 'categories'))->links('frontend.includes.custom-pagination') }}
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script src="{{ asset('js/pages/filter.js') }}"></script>
@endpush
