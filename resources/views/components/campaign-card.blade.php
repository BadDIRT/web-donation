<div
    class="group bg-white rounded-2xl overflow-hidden shadow-sm
           hover:shadow-xl transition-all duration-300 flex flex-col h-full border border-gray-100">

    {{-- ================= IMAGE ================= --}}
    <div class="relative overflow-hidden h-52">
        <img src="{{ asset('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}"
            class="w-full h-full object-cover
                   group-hover:scale-105 transition-transform duration-500">

        {{-- CATEGORY BADGE --}}
        <span
            class="absolute top-3 left-3
                   bg-green-500/90 backdrop-blur-sm text-white text-xs font-semibold
                   px-3 py-1 rounded-full shadow">
            {{ $campaign->category->name ?? 'Umum' }}
        </span>
    </div>

    <div class="p-5 flex flex-col flex-1 flex-grow">

        {{-- ================= META INFO ================= --}}
        <div class="flex items-center gap-2 text-xs text-gray-500 mb-2">
            <span class="flex items-center gap-1 text-green-600 font-medium">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ $campaign->category->name }}
            </span>
            <span class="text-gray-300">•</span>
            <span>{{ $campaign->donations()->count() }} Donatur</span>
        </div>

        {{-- ================= TITLE ================= --}}
        <h2 class="text-lg font-bold text-gray-800 line-clamp-2 leading-snug min-h-[3rem]">
            {{ $campaign->title }}
        </h2>

        {{-- ================= PENGELOLA (SOCIAL PROOF) ================= --}}
        <div class="flex items-center gap-2 mt-2 mb-3">
            <div class="w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 flex-shrink-0">
                <span class="text-[10px] font-bold uppercase">{{ $campaign->user->name[0] ?? 'U' }}</span>
            </div>
            <p class="text-xs text-gray-500">
                Oleh <span class="font-medium text-gray-700">{{ $campaign->user->name }}</span>
            </p>
        </div>

        {{-- ================= DESCRIPTION ================= --}}
        <p class="text-gray-500 text-sm leading-relaxed line-clamp-2">
            {{ $campaign->description }}
        </p>

        {{-- ================= PROGRESS & CTA WRAPPER ================= --}}
        <div class="mt-auto pt-4 border-t border-gray-100 space-y-3">

            @php
                $percent =
                    $campaign->target_amount > 0
                        ? min(100, ($campaign->current_amount / $campaign->target_amount) * 100)
                        : 0;
            @endphp

            {{-- PROGRESS BAR --}}
            <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                <div class="bg-gradient-to-r from-green-400 via-green-500 to-green-600 h-2 rounded-full transition-all duration-700"
                    style="width: {{ $percent }}%"></div>
            </div>

            {{-- MONEY INFO --}}
            <div class="flex justify-between items-end gap-2">
                <div>
                    <span class="text-xs text-gray-500 block">Terkumpul</span>
                    <p class="text-sm font-bold text-green-600 leading-none">
                        Rp {{ number_format($campaign->current_amount) }}
                    </p>
                </div>
                <p class="text-xs text-gray-400 text-right">
                    Target: Rp {{ number_format($campaign->target_amount) }}
                </p>
            </div>

            {{-- CTA BUTTON --}}
            <a href="{{ route('campaign.show', $campaign->slug) }}"
                class="w-full block text-center
                       bg-green-500 hover:bg-green-600
                       text-white py-2.5 rounded-xl font-semibold
                       transition shadow-sm hover:shadow-md
                       active:scale-[0.98] active:shadow-none">
                Donasi Sekarang
            </a>
        </div>

    </div>
</div>
