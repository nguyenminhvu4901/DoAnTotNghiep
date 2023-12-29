@extends('frontend.layouts.app')

@section('title', __('Update Information Staff'))

@section('content')
    <div class="mt-4 p-3 container-fluid card-school">
        <div class="p-3 pl-2 font-weight-bold">
            <h3><strong>@lang('Update Information Staff')</strong></h3>
        </div><!--row-->

        <div class="container-fluid p-3 form-school">
            <div>
                <form action="{{route('frontend.staff.update', ['id' => $staff->id])}}"
                      method="POST">
                    @csrf
                    @method('PUT')
                    @include('frontend.pages.staff.partials.form-fields')
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