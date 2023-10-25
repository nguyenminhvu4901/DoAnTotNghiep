{{-- NAME --}}
<div class="form-group row">
    <label for="input_name" class="col-sm-2 col-form-label">
        @lang('Product name') <span class="text-danger">*</span>
    </label>
    <div class="col-sm-5">
        <input type="text" class="form-control rounded {{ checkDisplayError($errors, 'name') }}" id="input_name"
            name="name" placeholder="@lang('Name')" value="{{ old('name') }}">
        <small id="error_name" class="error text-danger">{{ $errors->first('name') }}</small>
    </div>
</div>

<div class="form-group row">
    <label for="input_name" class="col-sm-2 col-form-label">
        @lang('Description') <span class="text-danger">*</span>
    </label>
    <div class="col-sm-5">
        <textarea id="input_name" cols="10" rows="5" name="description" placeholder="@lang('Description')"
            class="form-control rounded {{ checkDisplayError($errors, 'description') }}">
            {{ old('description') }}
        </textarea>
        <small id="error_name" class="error text-danger">{{ $errors->first('description') }}</small>
    </div>
</div>

<div class="form-group row">
    <label for="input_name" class="col-sm-2 col-form-label">
        @lang('Category name') <span class="text-danger">*</span>
    </label>
    <div class="col-sm-5">
        <select name="category" data-placeholder="@lang('Category')" class="form-control filter-select">
            <option value="">@lang('Category')</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">
                    {{ __($category->name) }}
                </option>
            @endforeach
        </select>
    </div>
</div>

@push('after-scripts')
    <script src="{{ asset('js/pages/formRules.js') }}"></script>
@endpush
