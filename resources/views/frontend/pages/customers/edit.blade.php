@extends('frontend.layouts.app')

@section('title', __('Update Information Customer'))

@section('content')
    <div class="mt-4 p-3 container-fluid card-school">
        <div class="p-3 pl-2 font-weight-bold">
            <h3><strong>@lang('Update Information Customer')</strong></h3>
        </div><!--row-->

        <div class="container-fluid p-3 form-school">
            <div>
                <form action="{{route('frontend.customers.update', ['id' => $customer->id])}}"
                      method="POST">
                    @csrf
                    @method('PUT')
                    @include('frontend.pages.customers.partials.form-fields')
                    <div class="form-group row">
                        <div class="col-12">
                            <button class="btn btn-primary rounded" type="submit">@lang('Update')</button>
                        </div>
                    </div>
                </form>
            </div>

        </div><!--row-->
    </div><!--container-->
@endsection