{{--EMAIL--}}
<div class="form-group row">
    <label for="input_email" class="col-sm-2 col-form-label">
        @lang('Email') <span class="text-danger">*</span>
    </label>
    <div class="col-sm-5">
        <input type="text" class="form-control {{ checkDisplayError($errors, 'email') }}"
               id="input_email" name="email"
               autocomplete="off"
               placeholder="@lang('Email')"
               value="{{ old('email') ?? (isset($customer) ? $customer->email : '') }}">
        <small id="error_email" class="error text-danger">{{ $errors->first('email') }}</small>
    </div>
</div>

{{--PASSWORD--}}
<div class="form-group row">
    <label for="input_password" class="col-sm-2 col-form-label">
        @lang('Password') <span class="text-danger">*</span>
    </label>
    <div class="col-sm-5">
        <input type="password"
               class="form-control {{ checkDisplayError($errors, 'password') }}"
               id="input_password" name="password"
               value="{{ old('password') }}"
               placeholder="{{isset($customer) ? __('Leave empty to keep old password') : __('Password')}}"
               data-toggle="password">
        <small id="error_password"
               class="error text-danger">{{ $errors->first('password') }}</small>
    </div>
</div>
@include('frontend.pages.partials.form.password-rule')

{{--NAME--}}
<div class="form-group row">
    <label for="input_name" class="col-sm-2 col-form-label">
        @lang('Full name') <span class="text-danger">*</span>
    </label>
    <div class="col-sm-5">
        <input type="text" class="form-control rounded {{ checkDisplayError($errors, 'name') }}"
               id="input_name" name="name"
               autocomplete="off"
               placeholder="@lang('Name')"
               value="{{ old('name') ?? (isset($customer) ? $customer->name : '') }}">
        <small id="error_name" class="error text-danger">{{ $errors->first('name') }}</small>
    </div>
</div>
@include('frontend.pages.partials.form.name-rule')

@push('after-scripts')
    <script src="{{ asset('js/pages/formRules.js') }}"></script>
@endpush

