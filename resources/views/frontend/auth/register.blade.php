@extends('frontend.layouts.app')

@section('title', __('Register'))

@section('content')
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
                                    <form class="mx-1 mx-md-4" action="{{ route('frontend.auth.register') }}"
                                        method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" name="name" id="name" class="form-control"
                                                    value="{{ old('name') }}" placeholder="{{ __('Name') }}"
                                                    maxlength="100" required autofocus autocomplete="name" />
                                            </div>
                                        </div><!--form-group-->
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="email" name="email" id="email" class="form-control"
                                                    placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}"
                                                    maxlength="255" required autocomplete="email" />
                                            </div>
                                        </div><!--form-group-->
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" name="password" id="password" class="form-control"
                                                    placeholder="{{ __('Password') }}" maxlength="100" required
                                                    autocomplete="new-password" data-toggle="password"/>
                                            </div>
                                        </div><!--form-group-->
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" name="password_confirmation"
                                                    id="password_confirmation" class="form-control"
                                                    placeholder="{{ __('Password Confirmation') }}" maxlength="100" required
                                                    autocomplete="new-password" data-toggle="password"/>
                                            </div>
                                        </div><!--form-group-->
                                        <div class="form-check d-flex justify-content-center mb-5">
                                            <div class="form-check">
                                                <input type="checkbox" name="terms" value="1" id="terms"
                                                    class="form-check-input" required>
                                                <label class="form-check-label" for="terms">
                                                    @lang('I agree to the') <a href="{{ route('frontend.pages.terms') }}"
                                                        target="_blank">@lang('Terms & Conditions')</a>
                                                </label>
                                            </div>
                                        </div><!--form-group-->
                                        <div class="d-flex justify-content-center">
                                            <button type="submit"
                                                class="btn btn-primary btn-lg mx-4">@lang('Register')</button>
                                            <a href="{{ route('frontend.auth.login') }}" class="btn btn-danger btn-lg"
                                                type="button">@lang('Back')</a>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                                        class="img-fluid" alt="Sample image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
