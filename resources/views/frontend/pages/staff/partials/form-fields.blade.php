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
               value="{{ old('email') ?? (isset($staff) ? $staff->email : '') }}">
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
               value="{{ old('password') ?? (isset($staff) ? $staff->password : '') }}"
               placeholder="{{isset($staff) ? __('Leave empty to keep old password') : __('Password')}}"
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
               value="{{ old('name') ?? (isset($staff) ? $staff->name : '') }}">
        <small id="error_name" class="error text-danger">{{ $errors->first('name') }}</small>
    </div>
</div>
@include('frontend.pages.partials.form.name-rule')

{{--GENDER--}}
<div class="form-group row">
    <label for="input_gender" class="col-sm-2 col-form-label">
        @lang('Gender') <span class="text-danger">*</span>
    </label>
    <div class="col-sm-5">
        <select class="form-control use-select2" name="gender" id="input_gender">
            @foreach(config('constants.gender') as $index => $gender)
                <option value="{{ $index }}"
                        {{ (old('gender') !== null ? old('gender') : (isset($staff) ? $staff->gender : null)) == $index ? 'selected' : '' }}
                >
                    {{ __($gender) }}
                </option>
            @endforeach
        </select>
        <small id="error_gender" class="error text-danger">{{ $errors->first('gender') }}</small>
    </div>
</div>

{{--BIRTHDAY--}}
<div class="form-group row">
    <label for="input_birthday"
           class="col-sm-2 col-form-label">
        @lang('Date of birth') <span class="text-danger">*</span>
    </label>
    <div class="col-sm-5">
        <input type="date" class="form-control rounded {{ checkDisplayError($errors, 'birthday') }}"
               id="input_birthday" name="birthday"
               placeholder="@lang('Birthday')"
               value="{{ old('birthday') ?? (isset($staff) ? $staff->birthday : '') }}">

        <small id="error_birthday" class="error text-danger">{{ $errors->first('birthday') }}</small>
    </div>
</div>

{{--PHONE--}}
<div class="form-group row">
    <label for="input_phone"
           class="col-sm-2 col-form-label">
        @lang('Phone number') <span class="text-danger">*</span>
    </label>
    <div class="col-sm-5">
        <input type="text" class="form-control rounded {{ checkDisplayError($errors, 'phone') }}"
               id="input_phone" name="phone"
               autocomplete="off"
               placeholder="@lang('Phone number')"
               value="{{ old('phone') ?? (isset($staff) ? $staff->phone : '') }}">
        <small id="error_phone" class="error text-danger">{{ $errors->first('phone') }}</small>
    </div>
</div>

{{--BIOGRAPHY--}}
<div class="form-group row">
    <label for="input_bio" class="col-sm-2 col-form-label d-flex align-content-center my-auto">
        @lang('Biography')
    </label>
    <div class="col-sm-10">
        <textarea id="input_bio" name="bio" class="p-2 w-100 border rounded"
                  placeholder="@lang('Biography')"
                  rows="4">{!! old('bio') ?? (isset($staff) ? $staff->bio : '') !!}</textarea>

        <small id="error_bio"
               class="error text-danger">{{ $errors->first('bio') }}</small>
    </div>
</div>

@push('after-scripts')
    <script src="{{ asset('js/pages/formRules.js') }}"></script>
    <script>
        $(function () {
            $('.use-select2').select2({
                width: '100%',
                placeholder: $(this).data('placeholder')
            });
        })
    </script>
@endpush