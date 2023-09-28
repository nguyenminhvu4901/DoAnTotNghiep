@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled mr-3">
                    <button class="btn btn-light" disabled type="button">
                        <span><i class="fas fa-chevron-left"></i> @lang('Previous')</span>
                    </button>
                </li>
            @else
                <li class="mr-3">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="btn btn-light">
                        <i class="fas fa-chevron-left"></i> @lang('Previous')
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled mx-2">
                        <button class="btn btn-light"><span>{{ $element }}</span></button>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active mx-2 btn btn-light"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}" class="btn">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="ml-3">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="btn btn-light">
                        @lang('Next') <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="disabled ml-3">
                    <button class="btn btn-light" disabled type="button">
                        <span>@lang('Next') <i class="fas fa-chevron-right"></i></span>
                    </button>
                </li>
            @endif
        </ul>
    </nav>
@endif