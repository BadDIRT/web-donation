<div
    x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 2500)"
    x-show="show"
    x-cloak
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-4 scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed top-24 right-6 z-[9999] w-full max-w-sm space-y-3"
>

    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="relative overflow-hidden rounded-2xl bg-white shadow-xl border border-green-100">
            <div class="flex items-start gap-4 p-5">

                {{-- ICON --}}
                <div class="flex-shrink-0">
                    <div class="w-9 h-9 rounded-full bg-green-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                {{-- MESSAGE --}}
                <div class="flex-1 text-sm text-gray-700 leading-relaxed">
                    {{ session('success') }}
                </div>

                {{-- CLOSE --}}
                <button @click="show = false" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- PROGRESS BAR --}}
            <div class="absolute bottom-0 left-0 h-1 bg-green-500 animate-[shrink_2.5s_linear_forwards]"></div>
        </div>
    @endif

    {{-- ERROR --}}
    @if($errors->any())
        <div class="relative overflow-hidden rounded-2xl bg-white shadow-xl border border-red-100">
            <div class="flex items-start gap-4 p-5">

                {{-- ICON --}}
                <div class="flex-shrink-0">
                    <div class="w-9 h-9 rounded-full bg-red-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                {{-- MESSAGE --}}
                <div class="flex-1 text-sm text-gray-700 space-y-1 leading-relaxed">
                    @foreach($errors->all() as $error)
                        <p>• {{ $error }}</p>
                    @endforeach
                </div>

                {{-- CLOSE --}}
                <button @click="show = false" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- PROGRESS BAR --}}
            <div class="absolute bottom-0 left-0 h-1 bg-red-500 animate-[shrink_2.5s_linear_forwards]"></div>
        </div>
    @endif

</div>
