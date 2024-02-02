<div class="pb-3 px-3 d-flex">
    @if (in_array(config('constants.payment_method.direct'), request('payment_method') ?? []))
        @include('frontend.includes.filter.filter-display-tag', [
            'text' => __('Payment method') . ': ' . __('Payment on delivery'),
            'name' => 'payment_method[]',
            'value' => config('constants.payment_method.direct'),
        ])
    @endif
    @if (in_array(config('constants.payment_method.vnpay'), request('payment_method') ?? []))
        @include('frontend.includes.filter.filter-display-tag', [
            'text' => __('Payment method') . ': ' . __('Payment via VNPay wallet'),
            'name' => 'payment_method[]',
            'value' => config('constants.payment_method.vnpay'),
        ])
    @endif
    @foreach (config('constants.status_return_order') as $key => $value)
        @if (in_array($value, request('status_return_order') ?? []))
            @include('frontend.includes.filter.filter-display-tag', [
                'text' => __('Status Return Order') . ': ' . __($key),
                'name' => 'status_return_order[]',
                'value' => $value,
            ])
        @endif
    @endforeach
</div>