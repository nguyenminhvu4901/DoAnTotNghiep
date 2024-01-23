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

    @if (isset($products))
    @foreach ($products as $product)
        @if (in_array($product->slug, request('products') ?? []))
            @include('frontend.includes.filter.filter-display-tag', [
                'text' => __('Product') . ': ' . $product->name,
                'name' => 'products[]',
                'value' => $product->slug,
            ])
        @endif
    @endforeach
@endif
</div>