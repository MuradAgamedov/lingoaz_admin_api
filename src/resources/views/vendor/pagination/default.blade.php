@if ($paginator->hasPages())
    <nav class="flex items-center justify-between mt-6" role="navigation" aria-label="Pagination Navigation">

        <div class="text-sm text-gray-500">
            Showing
            <span class="font-medium">{{ $paginator->firstItem() }}</span>
            to
            <span class="font-medium">{{ $paginator->lastItem() }}</span>
            of
            <span class="font-medium">{{ $paginator->total() }}</span>
            results
        </div>

        <div class="flex items-center gap-1">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-2 text-sm rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
                    Prev
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="px-3 py-2 text-sm rounded-lg bg-white border border-gray-200 text-gray-700 hover:bg-primary hover:text-white transition">
                    Prev
                </a>
            @endif

            {{-- Pages --}}
            @foreach ($elements as $element)

                @if (is_string($element))
                    <span class="px-3 py-2 text-sm text-gray-400">
                        {{ $element }}
                    </span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)

                        @if ($page == $paginator->currentPage())
                            <span class="px-3 py-2 text-sm rounded-lg bg-primary text-white">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                               class="px-3 py-2 text-sm rounded-lg bg-white border border-gray-200 text-gray-700 hover:bg-primary hover:text-white transition">
                                {{ $page }}
                            </a>
                        @endif

                    @endforeach
                @endif

            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="px-3 py-2 text-sm rounded-lg bg-white border border-gray-200 text-gray-700 hover:bg-primary hover:text-white transition">
                    Next
                </a>
            @else
                <span class="px-3 py-2 text-sm rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
                    Next
                </span>
            @endif

        </div>
    </nav>
@endif