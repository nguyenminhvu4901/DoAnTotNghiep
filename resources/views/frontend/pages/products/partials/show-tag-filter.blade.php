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
</div>