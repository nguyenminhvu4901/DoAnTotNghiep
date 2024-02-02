@extends('frontend.includes.filter.filter-modal')
@section('selection-body')
    <div class="d-flex align-items-center justify-content-between">
        <label class="col-form-label">
            @lang('Payment method')
        </label>
        <div class="pl-3 w-75">
            <select data-selected="{{ json_encode(request('payment_method')) }}" multiple name="payment_method[]"
                    data-placeholder="@lang('Payment method')" class="form-control w-100 filter-select">
                <option value="{{ config('constants.payment_method.direct') }}"
                        @if (in_array(config('constants.payment_method.direct'), request('payment_method') ?? [])) selected @endif>
                    @lang('Payment on delivery')
                </option>
                <option value="{{ config('constants.payment_method.vnpay') }}"
                        @if (in_array(config('constants.payment_method.vnpay'), request('payment_method') ?? [])) selected @endif>
                    @lang('Payment via VNPay wallet')
                </option>
            </select>
        </div>
    </div>
    <br>
    <div class="d-flex align-items-center justify-content-between">
        <label class="col-form-label">
            @lang('Status Return Order')
        </label>
        <div class="pl-3 w-75">
            <select data-selected="{{ json_encode(request('status_return_order')) }}" multiple name="status_return_order[]"
                    data-placeholder="@lang('Status Return Order')" class="form-control w-100 filter-select">
                @foreach (config('constants.status_return_order') as $key => $value)
                    <option value="{{ $value }}"
                            @if (in_array($value, request('status_return_order') ?? [])) selected @endif>
                        {{ __($key) }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
@endsection

