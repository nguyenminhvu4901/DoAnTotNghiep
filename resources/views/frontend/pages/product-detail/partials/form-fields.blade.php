{{-- NAME --}}
<div class="form-group row">
    <label for="input_name" class="col-sm-2 col-form-label">
        @lang('Product name')
    </label>
    <div class="col-sm-5">
        <input type="text" disabled class="form-control rounded {{ checkDisplayError($errors, 'name') }}" id="input_name"
            name="name" placeholder="@lang('Name')"
            value="{{ isset($product) ? $product->name : ''}}">
    </div>
</div>

<div class="form-group row">
    <label for="input_name" class="col-sm-2 col-form-label">
        @lang('Size') <span class="text-danger">*</span>
    </label>
    <div class="col-sm-5">
        <input type="text" class="form-control rounded {{ checkDisplayError($errors, 'size') }}" id="input_name"
            name="size" placeholder="@lang('Size')"
            value="{{ old('size') ?? (isset($productDetail) ? $productDetail->size : '') }}">
        <small id="error_size" class="error text-danger">{{ $errors->first('size') }}</small>
    </div>
</div>

<div class="form-group row">
    <label for="input_name" class="col-sm-2 col-form-label">
        @lang('Color') <span class="text-danger">*</span>
    </label>
    <div class="col-sm-5">
        <input type="text" class="form-control rounded {{ checkDisplayError($errors, 'color') }}" id="input_name"
            name="color" placeholder="@lang('Color')"
            value="{{ old('color') ?? (isset($productDetail) ? $productDetail->color : '') }}">
        <small id="error_color" class="error text-danger">{{ $errors->first('color') }}</small>
    </div>
</div>

<div class="form-group row">
    <label for="input_name" class="col-sm-2 col-form-label">
        @lang('Quantity') <span class="text-danger">*</span>
    </label>
    <div class="col-sm-5">
        <input type="text" class="form-control rounded {{ checkDisplayError($errors, 'quantity') }}" id="input_name"
            name="quantity" placeholder="@lang('Quantity')"
            value="{{ old('quantity') ?? (isset($productDetail) ? $productDetail->quantity : '') }}">
        <small id="error_quantity" class="error text-danger">{{ $errors->first('quantity') }}</small>
    </div>
</div>

<div class="form-group row">
    <label for="input_name" class="col-sm-2 col-form-label">
        @lang('Price') <span class="text-danger">*</span>
    </label>
    <div class="col-sm-5">
        <input type="text" class="form-control rounded {{ checkDisplayError($errors, 'price') }}" id="input_name"
            name="price" placeholder="@lang('Price')"
            value="{{ old('price') ?? (isset($productDetail) ? $productDetail->price : '') }}">
        <small id="error_price" class="error text-danger">{{ $errors->first('price') }}</small>
    </div>
</div>

{{-- <div class="form-group row">
    <label for="input_name" class="col-sm-2 col-form-label">
        @lang('Sale')
    </label>
    <div class="col-sm-5">
        <input type="text" class="form-control rounded {{ checkDisplayError($errors, 'sale') }}" id="input_name"
            name="sale" placeholder="@lang('Sale')"
            value="{{ old('sale') ?? (isset($productDetail) ? $productDetail->sale : '') }}">
        <small id="error_name" class="error text-danger">{{ $errors->first('sale') }}</small>
    </div>
</div> --}}

@push('after-scripts')
    <script src="{{ asset('js/pages/formRules.js') }}"></script>
@endpush
