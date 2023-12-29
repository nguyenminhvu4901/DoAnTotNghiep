@extends('frontend.layouts.app')

@section('title', __('ORDER'))

@push('after-styles')
    <style>
        .gradient-custom {
            background: #f6d365;

            background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));

            background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
        }
    </style>
@endpush

@section('content')
    <section>
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col col-lg-12">
                    <div class="card mb-3" style="border-radius: .5rem;">
                        <div class="row g-0">
                            <div class="col-md-2 gradient-custom text-center text-white"
                                 style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                     alt="Avatar" class="img-fluid my-5" style="width: 80px;"/>
                                <h3>{{ $staff->name }}</h3>
                            </div>
                            <div class="col-md-10">
                                <div class="card-body p-4">
                                    <h6>@lang('Information')</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>@lang('Email')</h6>
                                            <p class="text-muted">{{ $staff->email }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>@lang('Phone')</h6>
                                            <p class="text-muted">{{ $staff->phone }}</p>
                                        </div>
                                    </div>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>@lang('Gender')</h6>
                                            <p class="text-muted">{{ __($staff->genderLabel) }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>@lang('Birthday')</h6>
                                            <p class="text-muted">{{ formatDateTimeReadable($staff->birthday, true) }}</p>
                                        </div>
                                    </div>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>@lang('Bio')</h6>
                                            <p class="text-muted">{!! $staff->bio !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
