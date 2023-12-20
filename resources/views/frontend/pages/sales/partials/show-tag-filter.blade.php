<div class="pb-3 px-3 d-flex">
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