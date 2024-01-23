{{-- NAME --}}
<div class="form-group row">
    <label for="input_name" class="col-sm-2 col-form-label">
        @lang('Product name')
    </label>
    <div class="col-sm-5">
        <input type="text" disabled class="form-control rounded {{ checkDisplayError($errors, 'name') }}"
            id="input_name" name="name" placeholder="@lang('Name')"
            value="{{ isset($product->name) ? $product->name . ' (' . __('All Products') . ')' : $product->product->name . ' (' . $product->size . ', ' . $product->color . ')' }}">
    </div>
</div>

<div class="form-group row">
    <label for="input_type" class="col-sm-2 col-form-label">
        @lang('Type') <span class="text-danger">*</span>
    </label>
    <div class="col-3">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="type" id="flexRadioDefault1" value="0"
                {{ old('type', '0') == '0' ? 'checked' : '' }}>
            <label class="form-check-label" for="flexRadioDefault1">
                @lang('%')
            </label>
        </div>
        <small id="error_name" class="error text-danger">{{ $errors->first('type') }}</small>
    </div>
    <div class="col-3">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="type" id="flexRadioDefault2" value="1"
                {{ old('type') == '1' ? 'checked' : '' }}>
            <label class="form-check-label" for="flexRadioDefault2">
                @lang('Number')
            </label>
        </div>
    </div>
</div>

<div class="form-group row">
    <label for="input_value" class="col-sm-2 col-form-label">
        @lang('Value') <span class="text-danger">*</span>
    </label>
    <div class="col-sm-5">
        <input type="number" class="form-control rounded {{ checkDisplayError($errors, 'value') }}" id="input_value"
            name="value" placeholder="@lang('Value')"
            value="{{ old('value') ?? (isset($productDetail) ? $productDetail->color : '') }}">
        <small id="error_value" class="error text-danger">{{ $errors->first('value') }}</small>
    </div>
</div>

<div class="form-group row">
    <label for="input_name" class="col-sm-2 col-form-label">
        @lang('Start Date') <span class="text-danger">*</span>
    </label>
    <div class="col-sm-5">
        <input type="date" class="form-control rounded {{ checkDisplayError($errors, 'start_date') }}"
            id="input_name" name="start_date" placeholder="@lang('Sale')"
            value="{{ old('start_date') ?? (isset($productDetail) ? $productDetail->sale : '') }}">
        <small id="error_name" class="error text-danger">{{ $errors->first('start_date') }}</small>
    </div>
</div>

<div class="form-group row">
    <label for="input_name" class="col-sm-2 col-form-label">
        @lang('Expiry Date') <span class="text-danger">*</span>
    </label>
    <div class="col-sm-5">
        <input type="date" class="form-control rounded {{ checkDisplayError($errors, 'expiry_date') }}"
            id="input_name" name="expiry_date" placeholder="@lang('Expiry Date')"
            value="{{ old('start_date') ?? (isset($productDetail) ? $productDetail->sale : '') }}">
        <small id="error_name" class="error text-danger">{{ $errors->first('expiry_date') }}</small>
    </div>
</div>

<div class="form-group row">
    <label for="input_name" class="col-sm-2 col-form-label">
        @lang('Active') <span class="text-danger">*</span>
    </label>
    <div class="col-sm-5">
        <label class="switch">
            <input type="checkbox" name="is_active" checked>
            <span class="slider round"></span>
        </label>
    </div>
</div>
