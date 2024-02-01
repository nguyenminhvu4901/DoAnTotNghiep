<div class="pb-3 px-3 d-flex">
    @if (isset($categories))
        @foreach ($categories as $category)
            @if (in_array($category->slug, request('categories') ?? []))
                @include('frontend.includes.filter.filter-display-tag', [
                    'text' => __('Category') . ': ' . $category->name,
                    'name' => 'categories[]',
                    'value' => $category->slug,
                ])
            @endif
        @endforeach
    @endif
    @if (isset($productDetailColors))
        @foreach ($productDetailColors as $productDetailColor)
            @if (in_array($productDetailColor, request('colors') ?? []))
                @include('frontend.includes.filter.filter-display-tag', [
                    'text' => __('Color') . ': ' . $productDetailColor,
                    'name' => 'colors[]',
                    'value' => $productDetailColor,
                ])
            @endif
        @endforeach
    @endif
    @if (isset($productDetailSizes))
        @foreach ($productDetailSizes as $productDetailSize)
            @if (in_array($productDetailSize, request('sizes') ?? []))
                @include('frontend.includes.filter.filter-display-tag', [
                    'text' => __('Size') . ': ' . $productDetailSize,
                    'name' => 'sizes[]',
                    'value' => $productDetailSize,
                ])
            @endif
        @endforeach
    @endif
    @if (request('order_by') != null)
        @foreach(config('constants.order_by') as $key => $value)
            @if ($value == request('order_by'))
                @include('frontend.includes.filter.filter-display-tag', [
                    'text' => __('Order By') . ': ' . __($key),
                    'name' => 'order_by',
                    'value' => $value,
                ])
            @endif
        @endforeach
    @endif
    @if (request('min_price') != null)
        @include('frontend.includes.filter.filter-display-tag', [
            'text' => __('Min Price') . ': ' . request('min_price'),
            'name' => 'min_price',
            'value' => request('min_price'),
        ])
    @endif
    @if (request('max_price') != null)
        @include('frontend.includes.filter.filter-display-tag', [
            'text' => __('Max Price') . ': ' . request('max_price'),
            'name' => 'max_price',
            'value' => request('max_price'),
        ])
    @endif
</div>