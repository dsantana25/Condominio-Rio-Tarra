@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span class="page-link"><i class="material-icons">keyboard_arrow_left</i></span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="material-icons">keyboard_arrow_left</i></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                      @if($page == 1)
                        <li class="page-item active"><span class="page-link">PB</span></li>
                      @else
                        <li class="page-item active"><span class="page-link">{{ $page-1 }}</span></li>
                      @endif
                    @else
                      @if($page == 1)
                        <li class="page-item d-none d-md-block"><a class="page-link" href="{{ $url }}">PB</a></li>
                      @else
                        <li class="page-item d-none d-md-block"><a class="page-link" href="{{ $url }}">{{ $page-1 }}</a></li>
                      @endif
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="material-icons">keyboard_arrow_right</i></a></li>
        @else
            <li class="page-item disabled"><span class="page-link"><i class="material-icons">keyboard_arrow_right</i></span></li>
        @endif
    </ul>
@endif
