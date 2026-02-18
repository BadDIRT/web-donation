@if ($paginator->hasPages())
    <nav class="flex items-center justify-center gap-2 mt-16">

        {{-- PREVIOUS --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 text-sm rounded-xl bg-gray-100 text-gray-400 cursor-not-allowed">
                ←
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="px-4 py-2 text-sm rounded-xl bg-white border hover:bg-green-50 transition">
                ←
            </a>
        @endif

        {{-- PAGE NUMBERS --}}
        @foreach ($elements as $element)
            {{-- "..." --}}
            @if (is_string($element))
                <span class="px-4 py-2 text-sm text-gray-400">
                    {{ $element }}
                </span>
            @endif

            {{-- LINKS --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-4 py-2 text-sm rounded-xl bg-green-500 text-white font-semibold">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                            class="px-4 py-2 text-sm rounded-xl bg-white border hover:bg-green-50 transition">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- NEXT --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="px-4 py-2 text-sm rounded-xl bg-white border hover:bg-green-50 transition">
                →
            </a>
        @else
            <span class="px-4 py-2 text-sm rounded-xl bg-gray-100 text-gray-400 cursor-not-allowed">
                →
            </span>
        @endif

    </nav>

    {{-- INFO --}}
    <div class="text-center text-sm text-gray-500 mt-4">
        Menampilkan
        <span class="font-medium">{{ $paginator->firstItem() }}</span>
        –
        <span class="font-medium">{{ $paginator->lastItem() }}</span>
        dari
        <span class="font-medium">{{ $paginator->total() }}</span>
        campaign
    </div>
@endif
