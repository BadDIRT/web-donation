@if ($paginator->hasPages())
    <nav class="flex items-center justify-center gap-1">
        {{-- PREVIOUS --}}
        @if ($paginator->onFirstPage())
            <span class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-200 hover:text-slate-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
        @endif

        {{-- NUMBERS --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="w-8 h-8 flex items-center justify-center text-slate-400 text-xs">...</span>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span
                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-emerald-500 text-white text-xs font-bold shadow-sm shadow-emerald-500/20">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                            class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-200 hover:text-slate-700 text-xs font-medium transition-colors">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- NEXT --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-200 hover:text-slate-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        @else
            <span class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </span>
        @endif
    </nav>
@endif
