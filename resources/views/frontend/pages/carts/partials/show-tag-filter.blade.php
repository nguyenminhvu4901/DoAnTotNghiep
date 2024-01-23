<div class="pb-3 px-3 d-flex">
    @if (session()->has('coupon_name'))
        @include('frontend.includes.filter.filter-display-tag', [
            'text' => __('Coupon') . ': ' . session()->get('coupon_name'),
            'name' => 'old_coupon_name',
            'value' => session()->get('coupon_name'),
        ])
    @endif
</div>
