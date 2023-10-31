@extends('frontend.includes.filter.filter-modal')
@section('selection-body')
    <div class="d-flex align-items-center justify-content-between">
        <label class="col-form-label">
            @lang('Category')
        </label>
        <div class="pl-3 w-75">
            <select data-selected="{{ json_encode(request('category')) }}" multiple name="categories[]"
                    data-placeholder="@lang('Category')" class="form-control w-100 filter-select">
                @foreach ($categories as $category)
                    <option value="{{ $category->slug }}" @if (in_array($category->slug, request('categories') ?? [])) selected @endif>
                        {{ __($category->name) }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
@endsection


