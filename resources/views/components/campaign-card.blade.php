<div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">
    <img src="{{ asset('storage/'.$campaign->image) }}" 
         class="h-48 w-full object-cover">

    <div class="p-5">
        <h2 class="text-lg font-bold">
            {{ $campaign->title }}
        </h2>

        <p class="text-gray-600 text-sm mt-2 line-clamp-3">
            {{ $campaign->description }}
        </p>

        <div class="mt-4">
            @php
                $percent = ($campaign->target_amount > 0)
                    ? ($campaign->collected_amount / $campaign->target_amount) * 100
                    : 0;
            @endphp

            <div class="w-full bg-gray-200 h-2 rounded-full">
                <div class="bg-green-500 h-2 rounded-full"
                     style="width: {{ $percent }}%">
                </div>
            </div>

            <div class="flex justify-between text-sm mt-2">
                <span>Rp {{ number_format($campaign->collected_amount) }}</span>
                <span>Target: Rp {{ number_format($campaign->target_amount) }}</span>
            </div>
        </div>

        <a href="{{ route('campaign.show',$campaign->id) }}"
           class="block mt-4 bg-green-500 text-white text-center py-2 rounded-xl">
            Donasi Sekarang
        </a>
    </div>
</div>
