@extends('frontend.layouts.app')

@section('title', __('Create new option product'))

@section('content')
    <div class="mt-4 p-3 container">
        <div class="p-3 pl-2 font-weight-bold">
            <h3><strong>@lang('Create new option product')</strong></h3>
        </div><!--row-->

        <div class="container p-3">
            <div>
                <form action="{{ route('frontend.productDetails.store', ['id' => $product->id]) }}"
                      method="POST">
                    @csrf
                    @method('POST')
                    @include('frontend.pages.product-detail.partials.form-fields')
                    <div class="form-group row pt-3">
                        <div class="col-md-5">
                        </div>
                        <div class="col-md-7">
                            <button class="btn btn-primary" type="submit">@lang('Create')</button>
                            <a type="button" class="btn btn-danger ml-3" href="{{ route('frontend.productDetails.index') }}">
                                @lang('Exit')
                            </a>
                        </div>
                    </div>
                </form>
            </div>

        </div><!--row-->
    </div><!--container-->
@endsection