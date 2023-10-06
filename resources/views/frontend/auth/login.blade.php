@extends('frontend.layouts.app')

@section('title', __('Login'))

@section('content')
    {{-- <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Login')
                    </x-slot>

                    <x-slot name="body">
                        <x-forms.post :action="route('frontend.auth.login')">
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">@lang('E-mail Address')</label>

                                <div class="col-md-6">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" maxlength="255" required autofocus autocomplete="email" />
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">@lang('Password')</label>

                                <div class="col-md-6">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password') }}" maxlength="100" required autocomplete="current-password" />
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input name="remember" id="remember" class="form-check-input" type="checkbox" {{ old('remember') ? 'checked' : '' }} />

                                        <label class="form-check-label" for="remember">
                                            @lang('Remember Me')
                                        </label>
                                    </div><!--form-check-->
                                </div>
                            </div><!--form-group-->

                            @if (config('boilerplate.access.captcha.login'))
                                <div class="row">
                                    <div class="col">
                                        @captcha
                                        <input type="hidden" name="captcha_status" value="true" />
                                    </div><!--col-->
                                </div><!--row-->
                            @endif

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button class="btn btn-primary" type="submit">@lang('Login')</button>

                                    <x-utils.link :href="route('frontend.auth.password.request')" class="btn btn-link" :text="__('Forgot Your Password?')" />
                                </div>
                            </div><!--form-group-->

                            <div class="text-center">
                                @include('frontend.auth.includes.social')
                            </div>
                        </x-forms.post>
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-8-->
        </div><!--row-->
    </div><!--container--> --}}
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #ffffff;
        }

        .h-custom {
            height: calc(100vh - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100vh;
            }
        }

        wrapper {
            position: relative;
            min-height: 100vh;
        }

        section.vh-100 {
            height: calc(100% - 73px);
            /* Điều chỉnh chiều cao của section */
        }

        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
    <div class="wrapper">
        <section class="vh-100">
            <div class="container-fluid h-custom">
                <div class="row d-flex justify-content-center align-items-center vh-100">
                    <div class="col-md-9 col-lg-6 col-xl-5">
                        <img src="{{ asset('img/logo/logo-bg.png') }}" class="img-fluid" alt="Sample image">
                    </div>
                    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                        <form action="{{ route('frontend.auth.login') }}" method="POST">
                            @method('POST')
                            @csrf
                            <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                                <h1 class="mx-auto d-block">@lang('Login')</h1>
                            </div>
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" maxlength="255"
                                    required autofocus autocomplete="email" />
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-3">
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="{{ __('Password') }}" maxlength="100" required
                                    autocomplete="current-password" />
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <!-- Checkbox -->
                                <div class="form-check mb-0">
                                    <input name="remember" id="remember" class="form-check-input" type="checkbox"
                                        {{ old('remember') ? 'checked' : '' }} />
                                    <label class="form-check-label" for="remember">
                                        @lang('Remember Me')
                                    </label>
                                </div>
                                <x-utils.link :href="route('frontend.auth.password.request')" class="btn btn-link" :text="__('Forgot Your Password?')" />
                            </div>
                            <div class="text-center text-lg-start mt-4 pt-2">
                                <button type="button" class="btn btn-primary btn-lg"
                                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                                <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="{{ route('frontend.auth.register') }}"
                                        class="link-danger">Register</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
