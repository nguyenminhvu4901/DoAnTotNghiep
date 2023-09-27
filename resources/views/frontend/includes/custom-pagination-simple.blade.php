@if ($paginator->hasPages())
    <nav>
        <ul class="pagination d-flex align-items-center paginate-nav">
            <li class="text-wrap mr-2">
                {{$paginator->firstItem() . ' - ' . $paginator->lastItem() . ' / ' . $paginator->total()}}
            </li>
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled mr-1">
                    <button type="button" class="btn border-0 shadow-none">
                        <i class="fas fa-chevron-left custom-opacity-50"></i>
                    </button>
                </li>
            @else
                <li class="border-0 mr-1">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                       class="btn btn-light  border-0 shadow-none">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class=" border-0">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                       class="btn btn-light  border-0 shadow-none">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="disabled">
                    <button type="button" class="btn btn-light  border-0 shadow-none">
                        <i class="fas fa-chevron-right custom-opacity-50"></i>
                    </button>
                </li>
            @endif
        </ul>
    </nav>
@else
    <div>
        <br/><br/>
    </div>
@endif