@extends('frontend.layouts.app')

@section('title', __('Create new Customer'))

@section('content')
    <div class="mt-4 p-3 container-fluid card-school">
        <div class="p-3 pl-2 font-weight-bold">
            <h3><strong>@lang('Create new Customer')</strong></h3>
        </div><!--row-->

        <div class="container-fluid p-3 form-school">
            <div>
                <form action="{{route('frontend.customers.store')}}"
                      method="POST">
                    @csrf
                    @include('frontend.pages.customers.partials.form-fields')
                    <div class="form-group row">
                        <div class="col-7 text-right">
                            <button class="btn btn-primary rounded" type="submit">@lang('Create')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!--row-->
    </div><!--container-->
@endsection