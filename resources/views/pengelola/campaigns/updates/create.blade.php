@extends('layouts.app')

@section('title', 'Kabar Terbaru - ' . $campaign->title)

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50/20">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- BACK LINK --}}
            <a href="{{ route('pengelola.campaign.show', $campaign->slug) }}"
                class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-emerald-600 transition-colors mb-6 group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Detail Campaign
            </a>

            {{-- HEADER --}}
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-slate-800">Kabar Terbaru</h1>
                        <p class="text-xs text-slate-400">{{ $campaign->title }}</p>
                    </div>
                </div>
            </div>

            {{-- FORM BUAT KABAR --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-6 sm:p-8 mb-6">
                <h2 class="font-bold text-slate-800 mb-5 flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tulis Kabar Baru
                </h2>

                <form method="POST" action="{{ route('pengelola.updates.store', $campaign->id) }}"
                    enctype="multipart/form-data" x-data="{ preview: null }" class="space-y-5">

                    @csrf

                    {{-- TITLE --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Judul Kabar <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="title" required maxlength="255"
                            placeholder="Contoh: Dana sudah tersalurkan ke penerima manfaat"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all">
                    </div>

                    {{-- CONTENT --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Isi Kabar <span class="text-red-400">*</span>
                        </label>
                        <textarea name="content" required rows="8"
                            placeholder="Ceritakan perkembangan terbaru campaign ini kepada donatur..."
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all resize-y"></textarea>
                    </div>

                    {{-- IMAGE --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Foto <span class="text-slate-400 font-normal">(opsional)</span>
                        </label>

                        <div @click="$refs.imageInput.click()"
                            class="relative border-2 border-dashed border-slate-200 hover:border-emerald-400 rounded-2xl p-6 text-center cursor-pointer transition-colors group"
                            :class="preview ? 'border-emerald-400 bg-emerald-50/30' : ''">

                            <input type="file" name="image" accept="image/*" x-ref="imageInput"
                                @change="
                                let file = $event.target.files[0];
                                if (file) {
                                    let reader = new FileReader();
                                    reader.onload = (e) => preview = e.target.result;
                                    reader.readAsDataURL(file);
                                }
                            "
                                class="hidden">

                            <template x-if="!preview">
                                <div>
                                    <div
                                        class="w-12 h-12 rounded-xl bg-slate-100 group-hover:bg-emerald-100 flex items-center justify-center mx-auto mb-3 transition-colors">
                                        <svg class="w-6 h-6 text-slate-400 group-hover:text-emerald-500 transition-colors"
                                            fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <p class="text-sm font-medium text-slate-500">Klik untuk upload foto</p>
                                    <p class="text-[11px] text-slate-400 mt-1">JPG, PNG, Webp — Maks 2MB</p>
                                </div>
                            </template>

                            {{-- PREVIEW --}}
                            <template x-if="preview">
                                <div>
                                    <img :src="preview" class="max-h-48 mx-auto rounded-xl object-cover">
                                    <button type="button" @click.prevent="preview = null; $refs.imageInput.value = ''"
                                        class="mt-3 inline-flex items-center gap-1 text-xs font-medium text-red-500 hover:text-red-600">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus Foto
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>

                    {{-- SUBMIT --}}
                    <div class="flex items-center justify-end gap-3 pt-2">
                        <a href="{{ route('pengelola.campaign.show', $campaign->id) }}"
                            class="px-5 py-2.5 rounded-xl text-sm font-medium border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-semibold bg-gradient-to-r from-emerald-500 to-teal-500 text-white hover:from-emerald-600 hover:to-teal-600 shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/30 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            Publikasikan
                        </button>
                    </div>
                </form>
            </div>

            {{-- DAFTAR KABAR SUDAH DIBUAT --}}
            @if ($updates->count() > 0)
                <div class="space-y-4">
                    <h2 class="font-bold text-slate-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Riwayat Kabar ({{ $updates->count() }})
                    </h2>

                    @foreach ($updates as $update)
                        <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                            {{-- IMAGE --}}
                            @if ($update->image)
                                <div class="aspect-video bg-slate-100">
                                    <img src="{{ Storage::url($update->image) }}" alt="{{ $update->title }}"
                                        class="w-full h-full object-cover">
                                </div>
                            @endif

                            <div class="p-5">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-bold text-slate-800 mb-1">{{ $update->title }}</h3>
                                        <p class="text-xs text-slate-400 flex items-center gap-1.5 mb-3">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $update->created_at->translatedFormat('d F Y, H:i') }}
                                        </p>
                                        <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-line">
                                            {{ $update->content }}</p>
                                    </div>

                                    {{-- DELETE --}}
                                    <form method="POST"
                                        action="{{ route('pengelola.updates.destroy', [$campaign->id, $update->id]) }}"
                                        x-data="{ open: false }" class="flex-shrink-0">
                                        @csrf @method('DELETE')
                                        <button type="button" @click="open = true"
                                            class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400 hover:text-red-500 hover:border-red-300 hover:bg-red-50 transition-all">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>

                                        {{-- KONFIRMASI HAPUS --}}
                                        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-150"
                                            x-transition:enter-start="opacity-0 scale-95"
                                            x-transition:enter-end="opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-100"
                                            x-transition:leave-start="opacity-100 scale-100"
                                            x-transition:leave-end="opacity-0 scale-95" @click.outside="open = false"
                                            class="absolute z-10 right-0 mt-2 w-64 bg-white rounded-xl shadow-xl border border-slate-100 p-4">
                                            <p class="text-sm font-semibold text-slate-800 mb-1">Hapus kabar ini?</p>
                                            <p class="text-xs text-slate-500 mb-3">Tindakan ini tidak bisa dibatalkan.</p>
                                            <div class="flex gap-2">
                                                <button type="button" @click="open = false"
                                                    class="flex-1 px-3 py-1.5 rounded-lg text-xs font-medium border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">
                                                    Batal
                                                </button>
                                                <button type="submit"
                                                    class="flex-1 px-3 py-1.5 rounded-lg text-xs font-semibold bg-red-500 hover:bg-red-600 text-white transition-colors">
                                                    Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
@endsection
