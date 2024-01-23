@extends('frontend.layouts.app')

@section('title', __('Create new Staff'))

@section('content')
    <div class="mt-4 p-3 container-fluid card-school">
        <div class="p-3 pl-2 font-weight-bold">
            <h3><strong>@lang('Create new Staff')</strong></h3>
        </div><!--row-->

        <div class="container-fluid p-3 form-school">
            <div>
                <form action="{{route('frontend.staff.store')}}"
                      method="POST">
                    @csrf
                    @include('frontend.pages.staff.partials.form-fields')
                    <div class="form-group row">
                        <div class="col-12">
                            <button class="btn btn-primary rounded" type="submit">@lang('Create')</button>
                        </div>
                    </div>
                </form>
            </div>

        </div><!--row-->
    </div><!--container-->
@endsection