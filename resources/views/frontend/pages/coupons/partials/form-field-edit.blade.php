<div class="form-group row">
    <label for="input_name" class="col-sm-2 col-form-label">
        @lang('Coupon name') <span class="text-danger">*</span>
    </label>
    <div class="col-sm-5">
        <input type="text" name="name" class="form-control rounded {{ checkDisplayError($errors, 'name') }}"
            id="input_name" placeholder="@lang('Name')" value="{{ old('name') ?? $coupon->name }}">
        <small id="error_name" class="error text-danger">{{ $errors->first('name') }}</small>
    </div>
</div>

<div class="form-group row">
    <label for="input_type" class="col-sm-2 col-form-label">
        @lang('Coupon type') <span class="text-danger">*</span>
    </label>
    <div class="col-3">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="type" id="flexRadioDefault1" value="0"
                {{ $coupon->type == '0' ? 'checked' : '' }}>
            <label class="form-check-label" for="flexRadioDefault1">
                @lang('%')
            </label>
        </div>
        <small id="error_name" class="error text-danger">{{ $errors->first('type') }}</small>
    </div>
    <div class="col-3">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="type" id="flexRadioDefault2" value="1"
                {{ $coupon->type == '1' ? 'checked' : '' }}>
            <label class="form-check-label" for="flexRadioDefault2">
                @lang('VND')
            </label>
        </div>
    </div>
</div>

<div class="form-group row">
    <label for="input_value" class="col-sm-2 col-form-label">
        @lang('Coupon value') <span class="text-danger">*</span>
    </label>
    <div class="col-sm-5">
        <input type="number" name="value" class="form-control rounded {{ checkDisplayError($errors, 'value') }}"
            id="input_value" placeholder="@lang('Value')" value="{{ $coupon->value }}">
        <small id="error_value" class="error text-danger">{{ $errors->first('value') }}</small>
    </div>
</div>

<div class="form-group row">
    <label for="input_value" class="col-sm-2 col-form-label">
        @lang('Start Date') <span class="text-danger">*</span>
    </label>
    <div class="col-sm-5">
        <input type="date" name="start_date"
            class="form-control rounded {{ checkDisplayError($errors, 'start_date') }}" id="input_start_date"
            value="{{ $coupon->start_date }}">
        <small id="error_start_date" class="error text-danger">{{ $errors->first('start_date') }}</small>
    </div>
</div>

<div class="form-group row">
    <label for="input_value" class="col-sm-2 col-form-label">
        @lang('Expiry Date') <span class="text-danger">*</span>
    </label>
    <div class="col-sm-5">
        <input type="date" name="expiry_date"
            class="form-control rounded {{ checkDisplayError($errors, 'expiry_date') }}" id="input_expiry_date"
            value="{{ $coupon->expiry_date }}">
        <small id="error_expiry_date" class="error text-danger">{{ $errors->first('expiry_date') }}</small>
    </div>
</div>

<div class="form-group row">
    <label for="input_quantity" class="col-sm-2 col-form-label">
        @lang('Quantity') <span class="text-danger">*</span>
    </label>
    <div class="col-sm-5">
        <input type="number" name="quantity" class="form-control rounded {{ checkDisplayError($errors, 'quantity') }}"
            id="input_quantity" placeholder="@lang('Quantity')" value="{{ $coupon->quantity }}">
        <small id="error_quantity" class="error text-danger">{{ $errors->first('quantity') }}</small>
    </div>
</div>

<div class="form-group row">
    <label for="input_description" class="col-sm-2 col-form-label">
        @lang('Description')
    </label>
    <div class="col-sm-5">
        <textarea id="ckeditor" cols="10" rows="5" name="description" placeholder="@lang('Description')"
            class="form-control rounded {{ checkDisplayError($errors, 'description') }}">
            {{ $coupon->description }}
        </textarea>
        <small id="error_description" class="error text-danger">{{ $errors->first('description') }}</small>
    </div>
</div>

@push('after-scripts')
    <script src="{{ asset('js/pages/formRules.js') }}"></script>
@endpush
