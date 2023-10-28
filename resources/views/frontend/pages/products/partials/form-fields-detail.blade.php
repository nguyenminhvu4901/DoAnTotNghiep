{{-- NAME --}}
<div class="form-group row">
    <label for="input_name" class="col-sm-2 col-form-label">
        @lang('Product name') <span class="text-danger">*</span>
    </label>
    <div class="col-sm-5">
        <input type="text" class="form-control rounded {{ checkDisplayError($errors, 'name') }}" id="input_name"
            name="name" placeholder="@lang('Name')"
            value="{{ old('name') ?? (isset($product) ? $product->name : '') }}">
        <small id="error_name" class="error text-danger">{{ $errors->first('name') }}</small>
    </div>
</div>

<div class="form-group row">
    <label for="input_name" class="col-sm-2 col-form-label">
        @lang('Description') <span class="text-danger">*</span>
    </label>
    <div class="col-sm-5">
        <textarea id="ckeditor" cols="10" rows="5" name="description" placeholder="@lang('Description')"
            class="form-control rounded {{ checkDisplayError($errors, 'description') }}">
            {{ old('description') ?? (isset($product) ? $product->description : '') }}
        </textarea>
        <small id="error_name" class="error text-danger">{{ $errors->first('description') }}</small>
    </div>
</div>

@push('after-scripts')
    <script src="{{ asset('js/pages/formRules.js') }}"></script>
@endpush
