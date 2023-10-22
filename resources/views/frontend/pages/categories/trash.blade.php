@extends('frontend.layouts.app')

@section('title', __('Category management'))

@section('content')
    <div class="fade-in">
        @include('includes.partials.messages')
    </div><!--fade-in-->
    <div class="mt-4 rounded bg-white">
        <div class="p-3 pl-2 font-weight-bold text-center pb-5">
            <h3>
                @lang('Category management in trash')
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
                                @lang('Deleted date')
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
                        @forelse($categories as $category)
                            <tr>
                                <td class="text-center align-middle">{{ $loop->iteration + $categories->firstItem() - 1 }}
                                </td>
                                <td class="text-center align-middle">
                                    {{ $category->name }}
                                </td>
                                <td class="text-center align-middle">
                                    {{ $category->created_by }}
                                </td>
                                <td class="text-center align-middle">
                                    {{ $category->formatted_created_at }}
                                </td>
                                <td class="text-center align-middle">
                                    {{ $category->formatted_deleted_at }}
                                </td>
                                <td class="text-center align-middle">
                                    <form action="{{ route('frontend.categories.restore', ['id' => $category->id]) }}"
                                        method="GET">
                                        @csrf
                                        <button type="button" class="btn btn-link" href="#modalRestore" class="trigger-btn"
                                            data-toggle="modal">
                                            <i class="fas fa-trash-restore"></i>
                                        </button>
                                        @include('frontend.includes.modal.modal-restore')
                                    </form>
                                </td>
                                <td class="text-center align-middle">
                                    <form action="{{ route('frontend.categories.forceDelete', ['id' => $category->id]) }}"
                                        method="GET">
                                        @csrf
                                        <button type="button" class="btn btn-link" href="#modalDelete" class="trigger-btn"
                                            data-toggle="modal">
                                            <i class="fas fa-trash" style="color: #ff0000;"></i>
                                        </button>
                                        @include('frontend.includes.modal.modal-delete')
                                    </form>

                                </td>
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
                {{ $categories->onEachSide(1)->links('frontend.includes.custom-pagination') }}
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script src="{{ asset('js/pages/filter.js') }}"></script>
@endpush
