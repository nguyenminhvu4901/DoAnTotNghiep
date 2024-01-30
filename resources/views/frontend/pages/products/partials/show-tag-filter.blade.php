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
</div>