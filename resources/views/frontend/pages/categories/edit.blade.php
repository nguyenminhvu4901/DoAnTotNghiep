@extends('frontend.layouts.app')

@section('title', __('Update category'))

@section('content')
    <div class="mt-4 p-3 container">
        <div class="p-3 pl-2 font-weight-bold">
            <h3><strong>@lang('Update category')</strong></h3>
        </div><!--row-->

        <div class="container p-3">
            <div>
                <form action="{{ route('frontend.categories.update', ['slug' => $category->slug]) }}"
                      method="POST">
                    @csrf
                    @method('PUT')
                    @include('frontend.pages.categories.partials.form-fields')
                    <div class="form-group row pt-3">
                        <div class="col-md-5">
                        </div>
                        <div class="col-md-7">
                            <button class="btn btn-primary" type="submit">@lang('Update')</button>
                            <a type="button" class="btn btn-danger ml-3" href="{{ route('frontend.categories.index') }}">
                                @lang('Exit')
                            </a>
                        </div>
                    </div>
                </form>
            </div>

        </div><!--row-->
    </div><!--container-->
@endsection