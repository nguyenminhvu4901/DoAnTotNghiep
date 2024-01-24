@extends('frontend.layouts.app')

@section('title', __('STAFF MANAGEMENT'))

@section('content')
    <div class="fade-in">
        @include('includes.partials.messages')
    </div><!--fade-in-->
    <div class="mt-4 rounded bg-white">
        <div class="p-3 pl-2 font-weight-bold text-center pb-5">
            <h3>
                @lang('STAFF MANAGEMENT')
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
                <a class="btn-footer-modal btn btn-success rounded-10  ml-3"
                   href="{{ route('frontend.staff.importStaff') }}">@lang('Import Staff')</a>
                <a class="btn-footer-modal btn btn-outline-secondary rounded-10  ml-3"
                   href="{{ route('frontend.staff.exportStaff') }}">@lang('Export Staff')</a>
                <a class="btn-footer-modal btn btn-primary rounded-10 ml-3"
                   href="{{ route('frontend.staff.create') }}">@lang('Create New Staff')</a>
                <a class="btn-footer-modal btn btn-warning rounded-10 ml-3"
                   href="{{ route('frontend.staff.trash') }}">@lang('Staff Archive')</a>
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
                            @lang('Staff Information')
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
                    @forelse($staff as $eachStaff)
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration + $staff->firstItem() - 1 }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $eachStaff->name }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $eachStaff->email }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $eachStaff->formatted_created_at }}
                            </td>
                            <td class="text-center align-middle">
                                <a href="{{ route('frontend.staff.show', ['id' => $eachStaff->id]) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                            <td class="text-center align-middle">
                                <a href="{{ route('frontend.staff.edit', ['id' => $eachStaff->id]) }}">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </td>
                            <td class="text-center align-middle">
                                <form action="{{ route('frontend.staff.destroy', ['id' => $eachStaff->id]) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-link" href="#modalDelete-{{$eachStaff->id  }}"
                                            data-toggle="modal">
                                        <i class="fas fa-trash" style="color: #ff0000;"></i>
                                    </button>
                                    @include('frontend.pages.staff.partials.show-modal-delete', [
                                        'staffId' => $eachStaff->id,
                                    ])
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">@lang('Not found data')</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="pagination container-fluid pt-2 position-sticky">
                {{ $staff->onEachSide(1)->appends(request()->only('search'))->links('frontend.includes.custom-pagination') }}
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script src="{{ asset('js/pages/filter.js') }}"></script>
@endpush
