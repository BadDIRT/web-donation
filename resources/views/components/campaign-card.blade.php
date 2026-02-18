<div
    class="group bg-white rounded-2xl overflow-hidden shadow-md
           hover:shadow-xl transition-all duration-300 flex flex-col"
>

    {{-- IMAGE + CATEGORY BADGE --}}
    <div class="relative overflow-hidden">
        <img
            src="{{ asset('storage/' . $campaign->image) }}"
            alt="{{ $campaign->title }}"
            class="h-48 w-full object-cover
                   group-hover:scale-105 transition-transform duration-500"
        >

        {{-- CATEGORY BADGE --}}
        <span
            class="absolute top-3 left-3
                   bg-green-500/90 text-white text-xs font-semibold
                   px-3 py-1 rounded-full shadow"
        >
            {{ $campaign->category->name ?? 'Umum' }}
        </span>
    </div>

    <div class="p-5 flex flex-col flex-1 space-y-4">

        {{-- TITLE --}}
        <h2 class="text-lg font-bold text-gray-800 line-clamp-2">
            {{ $campaign->title }}
        </h2>

        {{-- DESCRIPTION --}}
        <p class="text-gray-600 text-sm line-clamp-3">
            {{ $campaign->description }}
        </p>

        {{-- PROGRESS --}}
        @php
            $percent = $campaign->target_amount > 0
                ? min(100, ($campaign->current_amount / $campaign->target_amount) * 100)
                : 0;
        @endphp

        <div class="space-y-2">

            <div class="flex justify-between text-xs text-gray-600">
                <span>Terkumpul</span>
                <span class="font-semibold text-green-600">
                    {{ number_format($percent, 0) }}%
                </span>
            </div>

            <div class="w-full bg-gray-200 h-2 rounded-full overflow-hidden">
                <div
                    class="bg-green-500 h-2 rounded-full transition-all duration-700"
                    style="width: {{ $percent }}%"
                ></div>
            </div>

            <div class="flex justify-between text-sm mt-1 text-gray-700">
                <span class="font-semibold">
                    Rp {{ number_format($campaign->current_amount) }}
                </span>
                <span class="text-gray-500 text-xs">
                    dari Rp {{ number_format($campaign->target_amount) }}
                </span>
            </div>

        </div>

        {{-- CTA --}}
        <a
            href="{{ route('campaign.show', $campaign) }}"
            class="mt-auto block text-center
                   bg-green-500 hover:bg-green-600
                   text-white py-2.5 rounded-xl font-semibold
                   transition shadow hover:shadow-lg"
        >
            Donasi Sekarang
        </a>

    </div>
</div>
