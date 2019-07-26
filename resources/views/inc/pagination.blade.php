{{-- <span class='d-inline-block text-center'>{{$restaurants->links()}}</span> --}}
@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="Go to page previous page">
            {{-- <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')"> --}}
                {{-- <span class="page-link" aria-hidden="true">&lsaquo;</span> --}}
                <span class="page-link" aria-hidden="true"><i class="fas fa-arrow-left"></i></span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Go to page previous page">
                {{-- <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"> --}}
                    {{-- &lsaquo; --}}
                    <span class="page-link" aria-hidden="true"><i class="fas fa-arrow-left"></i></span>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}" aria-label="Go to page {{ $page }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Go to page next page">
                {{-- <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"> --}}
                    {{-- &rsaquo; --}}
                    <span class="page-link" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                </a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="Go to page next page">
            {{-- <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')"> --}}
                {{-- <span class="page-link" aria-hidden="true">&rsaquo;</span> --}}
                <span class="page-link" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
            </li>
        @endif
    </ul>
@endif
