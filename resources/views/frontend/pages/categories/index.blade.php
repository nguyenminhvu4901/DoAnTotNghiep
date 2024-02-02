@extends('frontend.layouts.app')

@section('title', __('CATEGORY MANAGEMENT'))

@section('content')
    <div class="fade-in">
        @include('includes.partials.messages')
    </div><!--fade-in-->
    <div class="mt-4 rounded bg-white">
        <div class="p-3 pl-2 font-weight-bold text-center pb-5">
            <h3>
                @lang('CATEGORY MANAGEMENT')
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
                @hasPermission('user.category.create')
                <a class="btn-footer-modal btn btn-primary rounded-10"
                   href="{{ route('frontend.categories.create') }}">@lang('Create New Category')</a>
                @endhasPermission

{{--                @hasPermission('user.category.trash')--}}
{{--                <a class="btn-footer-modal btn btn-warning rounded-10 ml-3"--}}
{{--                   href="{{ route('frontend.categories.trash') }}">@lang('Category Archive')</a>--}}
{{--                @endhasPermission--}}
            </div>
        </div>
        <div class="px-3 pb-3 pt-0">
            <div class="table-responsive rounded">
                <table class="table table-hover table-striped border rounded" id="categories-table">
                    <thead class="bg-header-table">
                    <tr>
                        <th class="text-center">@lang('No.')</th>
                        <th class="text-center">
                            @lang('Category')
                        </th>
                        <th class="text-center">
                            @lang('Created by')
                        </th>
                        <th class="text-center">
                            @lang('Created date')
                        </th>
                        <th class="text-center">
                            @lang('Sale price')
                        </th>
                        @hasPermission('user.sale')
                        <th class="text-center">
                            @lang('Discount')
                        </th>
                        @endhasPermission
                        @hasPermission('user.category.edit')
                        <th class="text-center">
                            @lang('Update')
                        </th>
                        @endhasPermission
{{--                        @hasPermission('user.category.disable')--}}
{{--                        <th class="text-center">--}}
{{--                            @lang('Delete')--}}
{{--                        </th>--}}
{{--                        @endhasPermission--}}
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration + $categories->firstItem() - 1 }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $category->name }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $category->created_by ?? __('There is no creator') }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $category->formatted_created_at }}
                            </td>
                            <td class="text-center align-middle">
                                @if (!$category->saleCategory->isEmpty())
                                    {{ $category->saleCategory->first()->value }}
                                    {{ $category->saleCategory->first()->type == 1 ? __('VND') : '%' }}
                                @else
                                    @lang('There are no sale price')
                                @endif
                            </td>
                            @hasPermission('user.sale')
                            <td class="text-center align-middle">
                                @if ($category->saleCategory->isEmpty())
                                    <a
                                            href="{{ route('frontend.sales.createCategory', ['categoryId' => $category->id, 'level' => 'category']) }}">
                                        <i class="fas fa-tag"></i> @lang('Add')
                                    </a>
                                @elseif(!$category->saleCategory->isEmpty() && isset($category->sale->first()->id))
                                    <a
                                            href="{{ route('frontend.sales.edit', ['id' => $category->saleCategory->first()->id, 'level' => 'category']) }}">
                                        <i class="fas fa-edit"></i> @lang('Update')
                                    </a>
                                @else
                                    @lang('Product price has been reduced')
                                @endif
                            </td>
                            @endhasPermission
                            @hasPermission('user.category.edit')
                            <td class="text-center align-middle">
                                <a href="{{ route('frontend.categories.edit', ['categorySlug' => $category->slug]) }}">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </td>
                            @endhasPermission
{{--                            @hasPermission('user.category.disable')--}}
{{--                            <td class="text-center align-middle">--}}
{{--                                <form--}}
{{--                                        action="{{ route('frontend.categories.destroy', ['id' => $category->id]) }}"--}}
{{--                                        method="POST">--}}
{{--                                    @csrf--}}
{{--                                    @method('DELETE')--}}
{{--                                    <button type="button" class="btn btn-link" href="#modalDelete-{{ $category->id }}"--}}
{{--                                            class="trigger-btn"--}}
{{--                                            data-toggle="modal">--}}
{{--                                        <i class="fas fa-trash" style="color: #ff0000;"></i>--}}
{{--                                    </button>--}}
{{--                                    @include('frontend.pages.categories.partials.show-modal-delete', ['categoryId' => $category->id])--}}
{{--                                </form>--}}
{{--                            </td>--}}
{{--                            @endhasPermission--}}
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">@lang('Not found data')</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="pagination container-fluid pt-2 position-sticky">
                {{ $categories->onEachSide(1)->appends(request()->only('search','categories', 'products'))->links('frontend.includes.custom-pagination') }}
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script src="{{ asset('js/pages/filter.js') }}"></script>
@endpush
