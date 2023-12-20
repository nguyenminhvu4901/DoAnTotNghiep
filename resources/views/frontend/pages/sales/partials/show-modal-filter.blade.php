@extends('frontend.includes.filter.filter-modal')
@section('selection-body')
    <div class="d-flex align-items-center justify-content-between">
        <label class="col-form-label">
            @lang('Product')
        </label>
        <div class="pl-3 w-75">
            <select data-selected="{{ json_encode(request('products')) }}" multiple name="products[]"
                data-placeholder="@lang('Product')" class="form-control w-100 filter-select">
                @foreach ($products as $product)
                    <option value="{{ $product->slug }}" @if (in_array($product->slug, request('products') ?? [])) selected @endif>
                        {{ __($product->name) }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
@endsection
