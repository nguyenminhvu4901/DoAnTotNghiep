@extends('frontend.layouts.app')

@section('title', __('Login'))

@section('content')
    <div>
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
                                <h1 class="mx-auto d-block pb-5">@lang('Login')</h1>
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
                                    autocomplete="current-password" data-toggle="password"/>
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
                                <button type="submit" class="btn btn-primary btn-lg"
                                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                                <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="{{ route('frontend.auth.register') }}"
                                        class="small btn btn-link fw-bold mb-0">Register</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
