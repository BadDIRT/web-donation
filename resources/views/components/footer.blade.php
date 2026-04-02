<footer class="bg-white border-t border-gray-200 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ================= MAIN FOOTER ================= --}}
        <div class="py-12 lg:py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-16">

                {{-- COL 1: BRAND & DESCRIPTION --}}
                <div class="lg:col-span-1">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center shadow-md shadow-green-200/50 group-hover:shadow-green-300/50 transition-all">
                            {{-- Ikon Hati / Donasi --}}
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 21s-6.5-4.35-9-8.5C1.5 9.5 3.5 6 7 6c2 0 3.5 1.5 5 3.5C13.5 7.5 15 6 17 6c3.5 0 5.5 3.5 4 6.5-2.5 4.15-9 8.5-9 8.5z" />
                            </svg>
                        </div>

                        <span class="text-xl font-extrabold text-gray-800 tracking-tight">
                            Donasi<span class="text-green-500">Kita</span>
                        </span>
                    </a>
                    <p class="mt-4 text-sm text-gray-500 leading-relaxed max-w-xs">
                        Platform galang dana terpercaya dan transparan. Menyalurkan kebaikan langsung kepada yang
                        membutuhkan dengan pengawasan ketat.
                    </p>
                </div>

                {{-- COL 2: NAVIGASI --}}
                <div>
                    <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-5">Menu Utama</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}"
                                class="text-sm text-gray-600 hover:text-green-600 transition-colors">Beranda</a></li>
                        <li><a href="{{ route('campaign.index') }}"
                                class="text-sm text-gray-600 hover:text-green-600 transition-colors">Cari Campaign</a>
                        </li>
                        <li><a href="{{ route('campaign.create') }}"
                                class="text-sm text-gray-600 hover:text-green-600 transition-colors">Jadi Pengelola</a>
                        </li>
                        <li><a href="#"
                                class="text-sm text-gray-600 hover:text-green-600 transition-colors">Tentang Kami</a>
                        </li>
                    </ul>
                </div>

                {{-- COL 3: LAYANAN --}}
                <div>
                    <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-5">Layanan</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-sm text-gray-600 hover:text-green-600 transition-colors">Cara
                                Donasi</a></li>
                        <li><a href="#"
                                class="text-sm text-gray-600 hover:text-green-600 transition-colors">Panduan
                                Pengelola</a></li>
                        <li><a href="#"
                                class="text-sm text-gray-600 hover:text-green-600 transition-colors">Kebijakan
                                Privasi</a></li>
                        <li><a href="#"
                                class="text-sm text-gray-600 hover:text-green-600 transition-colors">Syarat &
                                Ketentuan</a></li>
                    </ul>
                </div>

                {{-- COL 4: KONTAK --}}
                <div>
                    <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-5">Kontak</h3>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 01-2.25-2.25m19.5 0v.003h.008v-.003h-.008a2.25 2.25 0 01-2.247-2.25H5.25A2.25 2.25 0 013 4.25h.008v-.003z" />
                            </svg>
                            admin@donasikita.com
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25m-15 0a15 15 0 0115 15m-15 0H5.25m0 0a15 15 0 0115-15m0 0h15" />
                            </svg>
                            Indonesia
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- ================= BOTTOM BAR ================= --}}
        <div class="border-t border-gray-200 py-6">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">

                <p class="text-xs sm:text-sm text-gray-500">
                    &copy; {{ date('Y') }} DonasiKita. All rights reserved.
                </p>

                {{-- SOCIAL ICONS --}}
                <div class="flex items-center gap-3">
                    {{-- Instagram --}}
                    <a href="#"
                        class="w-9 h-9 bg-gray-50 rounded-full flex items-center justify-center text-gray-400 hover:bg-pink-50 hover:text-pink-500 transition-colors group">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-200" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm0 2A3.75 3.75 0 004 7.75v8.5A3.75 3.75 0 007.75 20h8.5A3.75 3.75 0 0020 16.25v-8.5A3.75 3.75 0 0016.25 4h-8.5zM12 7a5 5 0 110 10 5 5 0 010-10zm0 2a3 3 0 100 6 3 3 0 000-6zm5.25-.75a.75.75 0 110 1.5.75.75 0 010-1.5z" />
                        </svg>
                    </a>

                    {{-- Facebook --}}
                    <a href="#"
                        class="w-9 h-9 bg-gray-50 rounded-full flex items-center justify-center text-gray-400 hover:bg-blue-50 hover:text-blue-600 transition-colors group">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-200" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.99 3.66 9.12 8.44 9.88v-6.99H7.9v-2.89h2.54V9.41c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56v1.87h2.78l-.44 2.89h-2.34v6.99C18.34 21.12 22 16.99 22 12z" />
                        </svg>
                    </a>

                    {{-- Youtube --}}
                    <a href="#"
                        class="w-9 h-9 bg-gray-50 rounded-full flex items-center justify-center text-gray-400 hover:bg-red-50 hover:text-red-500 transition-colors group">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-200" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path d="M10 15l5.19-3L10 9v6z" />
                            <path
                                d="M21.8 8.001a2.75 2.75 0 00-1.94-1.94C18.07 6 12 6 12 6s-6.07 0-7.86.061a2.75 2.75 0 00-1.94 1.94A28.7 28.7 0 002 12a28.7 28.7 0 00.2 3.999 2.75 2.75 0 001.94 1.94C5.93 18 12 18 12 18s6.07 0 7.86-.061a2.75 2.75 0 001.94-1.94A28.7 28.7 0 0022 12a28.7 28.7 0 00-.2-3.999z" />
                        </svg>
                    </a>

                    {{-- WhatsApp --}}
                    <a href="#"
                        class="w-9 h-9 bg-gray-50 rounded-full flex items-center justify-center text-gray-400 hover:bg-green-50 hover:text-green-500 transition-colors group">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-200" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 2a10 10 0 00-8.94 14.56L2 22l5.6-1.47A10 10 0 1012 2zm0 2a8 8 0 018 8c0 4.42-3.58 8-8 8a7.96 7.96 0 01-4.1-1.12l-.29-.17-3.32.87.89-3.23-.19-.33A7.96 7.96 0 014 12a8 8 0 018-8zm3.71 10.29c-.2-.1-1.18-.58-1.36-.65-.18-.07-.31-.1-.44.1-.13.2-.51.65-.62.78-.11.13-.23.15-.43.05-.2-.1-.84-.31-1.6-.99-.59-.52-.99-1.16-1.11-1.36-.12-.2-.01-.31.09-.41.09-.09.2-.23.3-.34.1-.11.13-.2.2-.33.07-.13.03-.25-.02-.35-.05-.1-.44-1.06-.61-1.45-.16-.39-.33-.34-.44-.35-.11-.01-.24-.01-.37-.01-.13 0-.35.05-.53.25-.18.2-.7.68-.7 1.65s.72 1.91.82 2.04c.1.13 1.41 2.15 3.42 3.02.48.21.85.34 1.14.44.48.15.92.13 1.27.08.39-.06 1.18-.48 1.35-.95.17-.47.17-.87.12-.95-.05-.08-.18-.13-.38-.23z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

    </div>
</footer>
