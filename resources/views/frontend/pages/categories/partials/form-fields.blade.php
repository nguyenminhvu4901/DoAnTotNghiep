{{--NAME--}}
<div class="form-group row">
    <label for="input_name" class="col-sm-2 col-form-label">
        @lang('Category name') <span class="text-danger">*</span>
    </label>
    <div class="col-sm-5">
        <input type="text" class="form-control rounded {{ checkDisplayError($errors, 'name') }}"
               id="input_name" name="name"
               placeholder="@lang('Name')"
               value="{{ old('name') ?? (isset($category) ? $category->name : '') }}">
        <small id="error_name" class="error text-danger">{{ $errors->first('name') }}</small>
    </div>
</div>
{{--@include('frontend.pages.partials.form.name-rule')--}}

@push('after-scripts')
    <script src="{{ asset('js/pages/formRules.js') }}"></script>
@endpush