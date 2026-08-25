@if ($paginator->hasPages())
    <div class="custom-pagination">

        {{-- Showing results --}}
        <div class="pagination-info">
            Showing
            <strong>{{ $paginator->firstItem() }}</strong>
            to
            <strong>{{ $paginator->lastItem() }}</strong>
            of
            <strong>{{ $paginator->total() }}</strong>
            results
        </div>

        {{-- Pagination --}}
        <div class="pagination-links">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span class="pagination-btn disabled">‹</span>
            @else
                <a
                    href="{{ $paginator->previousPageUrl() }}"
                    class="pagination-btn"
                >
                    ‹
                </a>
            @endif


            {{-- Pages --}}
            @foreach ($elements as $element)

                {{-- "Three Dots" Separator --}}
                @if (is_string($element))

                    <span class="pagination-dots">
                        {{ $element }}
                    </span>

                @endif


                {{-- Array Of Links --}}
                @if (is_array($element))

                    @foreach ($element as $page => $url)

                        @if ($page == $paginator->currentPage())

                            <span class="pagination-btn active">
                                {{ $page }}
                            </span>

                        @else

                            <a
                                href="{{ $url }}"
                                class="pagination-btn"
                            >
                                {{ $page }}
                            </a>

                        @endif

                    @endforeach

                @endif

            @endforeach


            {{-- Next --}}
            @if ($paginator->hasMorePages())

                <a
                    href="{{ $paginator->nextPageUrl() }}"
                    class="pagination-btn"
                >
                    ›
                </a>

            @else

                <span class="pagination-btn disabled">
                    ›
                </span>

            @endif

        </div>

    </div>
@endif
<style>
.custom-pagination {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px;
    border-top: 1px solid #e5e7eb;
}

.pagination-info {
    font-size: 14px;
    color: #6b7280;
}

.pagination-info strong {
    color: #374151;
    font-weight: 600;
}

.pagination-links {
    display: flex;
    align-items: center;
    gap: 6px;
}

.pagination-btn {
    min-width: 38px;
    height: 38px;
    padding: 0 10px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    border: 1px solid #d1d5db;
    border-radius: 6px;

    background: #fff;
    color: #374151;

    font-size: 14px;
    text-decoration: none;

    box-sizing: border-box;
}

.pagination-btn:hover {
    background: #f3f4f6;
}

.pagination-btn.active {
    background: #2563eb;
    border-color: #2563eb;
    color: #fff;
}

.pagination-btn.disabled {
    color: #9ca3af;
    background: #f9fafb;
    cursor: not-allowed;
}

.pagination-dots {
    min-width: 30px;
    text-align: center;
    color: #6b7280;
}
</style>