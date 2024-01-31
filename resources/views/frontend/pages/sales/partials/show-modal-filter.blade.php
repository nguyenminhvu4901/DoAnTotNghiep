@extends('frontend.includes.filter.filter-modal')
@section('selection-body')
    <div class="d-flex align-items-center justify-content-between">
        <label class="col-form-label">
            @lang('Category')
        </label>
        <div class="pl-3 w-75">
            <select data-selected="{{ json_encode(request('categories')) }}" multiple name="categories[]"
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
            @lang('Product')
        </label>
        <div class="pl-3 w-75">
            <select data-selected="{{ json_encode(request('products')) }}" multiple name="products[]"
                    data-placeholder="@lang('Product')" class="form-control w-100 filter-select">
                @foreach ($products as $product)
                    <option value="{{ $product->slug }}"
                            @if (in_array($product->slug, request('products') ?? [])) selected @endif>
                        {{ __($product->name) }}
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
@endsection
