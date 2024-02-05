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
                    <option value="{{ $category->slug }}"
                            @if (in_array($category->slug, request('categories') ?? [])) selected @endif>
                        {{ __($category->name) }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <br>
    <div class="d-flex align-items-center justify-content-between">
        <label class="col-form-label">
            @lang('Color')
        </label>
        <div class="pl-3 w-75">
            <select data-selected="{{ json_encode(request('colors')) }}" multiple name="colors[]"
                    data-placeholder="@lang('Color')" class="form-control w-100 filter-select">
                @foreach ($productDetailColors as $productDetailColor)
                    <option value="{{ $productDetailColor }}"
                            @if (in_array($productDetailColor, request('colors') ?? [])) selected @endif>
                        {{ __($productDetailColor) }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <br>
    <div class="d-flex align-items-center justify-content-between">
        <label class="col-form-label">
            @lang('Size')
        </label>
        <div class="pl-3 w-75">
            <select data-selected="{{ json_encode(request('sizes')) }}" multiple name="sizes[]"
                    data-placeholder="@lang('Size')" class="form-control w-100 filter-select">
                @foreach ($productDetailSizes as $productDetailSize)
                    <option value="{{ $productDetailSize }}"
                            @if (in_array($productDetailSize, request('sizes') ?? [])) selected @endif>
                        {{ __($productDetailSize) }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <br>
    <div class="d-flex align-items-center justify-content-between">
        <label class="col-form-label">
            @lang('Price')
        </label>
        <div class="pl-3 w-75 d-flex">
            <input class="form-control" name="min_price" value="{{ request('min_price') }}" placeholder="@lang('Min')">
            <input class="form-control ml-2" name="max_price" value="{{ request('max_price') }}"
                   placeholder="@lang('Max')">
        </div>
    </div>
@endsection


