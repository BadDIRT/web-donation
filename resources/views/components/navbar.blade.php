<nav x-data="{
    scrolled: false,
    openCampaign: false,
    timeout: null,
    mobileOpen: false,
    mobileCampaignOpen: false,
    logoutOpen: false,
    notificationOpen: false,

    categories: [
        { label: 'Agama', slug: 'agama' },
        { label: 'Pendidikan', slug: 'pendidikan' },
        { label: 'Kesehatan', slug: 'kesehatan' },
        { label: 'Bencana Alam', slug: 'bencana-alam' },
        { label: 'Sosial', slug: 'sosial' },
    ]
}" x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 20)"
    :class="scrolled ? 'bg-white shadow-md' : 'bg-white/70 backdrop-blur-md'"
    class="fixed top-0 left-0 w-full z-50 transition-all duration-300">
    <template x-teleport="body">
        <div x-show="logoutOpen" x-cloak x-transition.opacity x-trap.noscroll="logoutOpen"
            class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50 backdrop-blur-sm">
            <div @click.outside="logoutOpen = false" class="bg-white rounded-2xl p-6 w-full max-w-sm shadow-xl">
                {{-- ICON --}}
                <div class="flex justify-center mb-4">
                    <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </div>

                <h2 class="text-lg font-semibold text-center">
                    Konfirmasi Logout
                </h2>
                <p class="text-sm text-gray-500 text-center mt-2">
                    Apakah kamu yakin ingin keluar dari akun ini?
                </p>

                <div class="flex gap-3 mt-6">
                    <button @click="logoutOpen = false" class="w-1/2 border rounded-xl py-2 hover:bg-gray-50">
                        Batal
                    </button>

                    <form action="{{ route('logout') }}" method="POST" class="w-1/2">
                        @csrf
                        <button class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-xl">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </template>


    <div class="container mx-auto px-4 py-4 flex justify-between items-center">

        {{-- LOGO --}}
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
            <span class="text-2xl font-bold text-gray-800 tracking-tight">
                Donasi<span class="text-green-500">Kita</span>
            </span>
        </a>

        {{-- DESKTOP MENU --}}
        <div class="hidden md:flex items-center space-x-6 font-medium">

            <a href="{{ route('home') }}" class="hover:text-green-600">
                Beranda
            </a>

            {{-- CAMPAIGN DROPDOWN (DESKTOP) --}}
            <div class="relative" @mouseenter="clearTimeout(timeout); openCampaign = true"
                @mouseleave="timeout = setTimeout(() => openCampaign = false, 150)">

                <button
                    class="flex items-center gap-1.5 px-3 py-2 hover:text-green-600 transition-all duration-150"
                    :class="openCampaign && 'text-emerald-600 bg-emerald-50/50'">
                    Campaign
                    <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="openCampaign && 'rotate-180'"
                        fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="openCampaign" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-1.5 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 -translate-y-1 scale-95" x-cloak
                    class="absolute left-0 mt-2 w-60 bg-white rounded-2xl shadow-xl shadow-black/10 border border-slate-100/80 py-2 origin-top-left z-50">

                    <a href="{{ route('campaign.index') }}"
                        class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition-colors duration-150">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Semua Campaign
                    </a>

                    <div class="my-2 border-t border-slate-100"></div>

                    <template x-for="category in categories" :key="category.slug">
                        <a :href="`{{ route('campaign.index') }}?category=${category.slug}`"
                            class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-emerald-50/50 hover:text-emerald-700 transition-colors duration-150 group">
                            <span
                                class="w-1.5 h-1.5 rounded-full bg-slate-300 group-hover:bg-emerald-500 transition-colors duration-150 flex-shrink-0"></span>
                            <span x-text="category.label"></span>
                        </a>
                    </template>
                </div>
            </div>

            @auth
                <a href="{{ route('dashboard') }}" class="hover:text-green-600">
                    Dashboard
                </a>

                @auth
                    <div class="relative" @mouseenter="clearTimeout(timeout); notificationOpen = true"
                        @mouseleave="timeout = setTimeout(() => notificationOpen = false, 150)">

                        <button @click="notificationOpen = !notificationOpen"
                            class="relative p-2 rounded-xl hover:bg-slate-100 focus:outline-none transition-colors duration-150"
                            :class="notificationOpen && 'bg-slate-100'">

                            {{-- ICON --}}
                            <svg class="w-[22px] h-[22px] text-slate-600 transition-colors"
                                :class="notificationOpen && 'text-emerald-600'" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 17h5l-1.4-1.4A2 2 0 0118 14V11a6 6 0 00-12 0v3a2 2 0 01-.6 1.4L4 17h5m6 0a3 3 0 11-6 0" />
                            </svg>

                            {{-- BADGE --}}
                            @if ($unreadCount > 0)
                                <span class="absolute top-1 right-1 flex h-4 w-4 items-center justify-center">
                                    <span
                                        class="absolute inline-flex h-full w-full animate-ping rounded-full bg-red-400 opacity-75"></span>
                                    <span
                                        class="relative inline-flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-[9px] font-bold text-white shadow-sm">
                                        {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                                    </span>
                                </span>
                            @endif
                        </button>

                        {{-- DROPDOWN --}}
                        <div x-show="notificationOpen" @click.outside="notificationOpen = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                            x-transition:leave-end="opacity-0 -translate-y-1 scale-95" x-cloak
                            class="absolute right-0 mt-2.5 w-96 bg-white rounded-2xl shadow-xl shadow-black/10 border border-slate-200/80 overflow-hidden z-50 origin-top-right">

                            {{-- HEADER --}}
                            <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-bold text-slate-800">Notifikasi</h3>
                                        @if ($unreadCount > 0)
                                            <p class="text-[10px] text-emerald-600 font-semibold">{{ $unreadCount }} baru</p>
                                        @endif
                                    </div>
                                </div>
                                <a href="{{ route('notifications.index') }}"
                                    class="text-[10px] font-bold uppercase tracking-wider text-slate-400 hover:text-emerald-600 transition-colors">
                                    Tandai dibaca
                                </a>
                            </div>

                            {{-- LIST --}}
                            <div class="max-h-[400px] overflow-y-auto divide-y divide-slate-100">
                                @forelse($notifications as $notif)
                                    <a href="{{ route('notifications.read', $notif->id) }}"
                                        class="flex gap-3 px-5 py-4 text-sm transition-colors duration-100
                          {{ !$notif->is_read ? 'bg-emerald-50/40 hover:bg-emerald-50' : 'hover:bg-slate-50' }}">

                                        {{-- ICON TYPE --}}
                                        <div
                                            class="w-9 h-9 rounded-xl flex-shrink-0 flex items-center justify-center mt-0.5
                        @if (str_contains($notif->type, 'approve') ||
                                str_contains($notif->type, 'success') ||
                                str_contains($notif->type, 'ended')) bg-emerald-100
                        @elseif(str_contains($notif->type, 'reject') || str_contains($notif->type, 'failed'))
                            bg-red-100
                        @elseif(str_contains($notif->type, 'request') ||
                                str_contains($notif->type, 'pending') ||
                                str_contains($notif->type, 'submitted'))
                            bg-amber-100
                        @elseif(str_contains($notif->type, 'withdraw') || str_contains($notif->type, 'income'))
                            bg-blue-100
                        @else bg-slate-100 @endif">

                                            @if (str_contains($notif->type, 'approve') ||
                                                    str_contains($notif->type, 'success') ||
                                                    str_contains($notif->type, 'ended'))
                                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @elseif(str_contains($notif->type, 'reject') || str_contains($notif->type, 'failed'))
                                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @elseif(str_contains($notif->type, 'request') ||
                                                    str_contains($notif->type, 'pending') ||
                                                    str_contains($notif->type, 'submitted'))
                                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @elseif(str_contains($notif->type, 'withdraw') || str_contains($notif->type, 'income'))
                                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @endif
                                        </div>

                                        {{-- CONTENT --}}
                                        <div class="min-w-0 flex-1">
                                            <div class="flex items-start justify-between gap-2">
                                                <p
                                                    class="text-sm font-semibold text-slate-800 truncate {{ !$notif->is_read && 'text-emerald-800' }}">
                                                    {{ $notif->title }}
                                                </p>
                                                @if (!$notif->is_read)
                                                    <div
                                                        class="w-2 h-2 rounded-full bg-emerald-500 flex-shrink-0 mt-1.5 shadow-sm shadow-emerald-500/30">
                                                    </div>
                                                @endif
                                            </div>
                                            <p class="text-xs text-slate-500 mt-0.5 line-clamp-2 leading-relaxed">
                                                {{ $notif->message }}
                                            </p>
                                            <p class="text-[10px] text-slate-400 mt-1.5 font-medium">
                                                {{ $notif->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </a>
                                @empty
                                    <div class="px-5 py-16 text-center">
                                        <div
                                            class="w-14 h-14 mx-auto bg-slate-100 rounded-2xl flex items-center justify-center mb-4">
                                            <svg class="w-7 h-7 text-slate-300" fill="none" stroke="currentColor"
                                                stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                            </svg>
                                        </div>
                                        <p class="text-slate-500 font-semibold text-sm">Belum ada notifikasi</p>
                                        <p class="text-slate-400 text-xs mt-1">Semua update terbaru akan muncul di sini</p>
                                    </div>
                                @endforelse
                            </div>

                            {{-- FOOTER --}}
                            <a href="{{ route('notifications.index') }}"
                                class="flex items-center justify-center gap-2 px-5 py-3.5 text-xs font-bold text-emerald-600 hover:bg-emerald-50 border-t border-slate-100 transition-colors duration-150 group">
                                Lihat Semua Notifikasi
                                <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none"
                                    stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endauth

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="button" @click="logoutOpen = true" class="text-red-500 hover:underline">
                        Logout
                    </button>

                </form>
            @else
                <a href="{{ route('login') }}" class="hover:text-green-600">
                    Login
                </a>

                <a href="{{ route('register') }}"
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl">
                    Daftar
                </a>
            @endauth
        </div>

        {{-- HAMBURGER (MOBILE) --}}
        <button @click="mobileOpen = !mobileOpen" class="relative md:hidden text-gray-700 focus:outline-none">

            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>

            {{-- BADGE NOTIF MOBILE --}}
            @if ($unreadCount > 0)
                <span
                    class="absolute -top-1 -right-1 bg-red-500 text-white text-xs
                   w-5 h-5 flex items-center justify-center rounded-full">
                    {{ $unreadCount }}
                </span>
            @endif
        </button>

    </div>

    {{-- MOBILE MENU --}}
    <div x-show="mobileOpen" x-transition x-cloak class="md:hidden bg-white border-t">
        <div class="px-4 py-4 space-y-3 font-medium">

            <a href="{{ route('home') }}" class="block py-2 hover:text-green-600">
                Beranda
            </a>

            {{-- MOBILE CAMPAIGN --}}
            <div>
                <button @click="mobileCampaignOpen = !mobileCampaignOpen"
                    class="flex justify-between items-center w-full py-2 hover:text-green-600">
                    Campaign
                    <svg class="w-4 h-4 transition" :class="mobileCampaignOpen ? 'rotate-180' : ''" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="mobileCampaignOpen" x-transition class="pl-4 mt-2 space-y-2">
                    <a href="{{ route('campaign.index') }}" class="block text-sm hover:text-green-600">
                        Semua Campaign
                    </a>

                    <template x-for="category in categories" :key="category.slug">
                        <a :href="`{{ route('campaign.index') }}?category=${category.slug}`"
                            class="block text-sm hover:text-green-600" x-text="category.label"></a>
                    </template>
                </div>
            </div>

            @auth
                <a href="{{ route('dashboard') }}" class="block py-2 hover:text-green-600">
                    Dashboard
                </a>

                @auth
                    <a href="{{ route('notifications.index') }}"
                        class="flex items-center justify-between py-2
          {{ $unreadCount > 0 ? 'text-green-600 font-semibold' : '' }}">
                        <span>Notifikasi</span>

                        @if ($unreadCount > 0)
                            <span class="bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">
                                {{ $unreadCount }}
                            </span>
                        @endif
                    </a>
                @endauth

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="button" @click="logoutOpen = true" class="text-red-500 py-2">
                        Logout
                    </button>

                </form>
            @else
                <a href="{{ route('login') }}" class="block py-2 hover:text-green-600">
                    Login
                </a>

                <a href="{{ route('register') }}"
                    class="block text-center bg-green-500 hover:bg-green-600 text-white py-2 rounded-xl">
                    Daftar
                </a>
            @endauth

        </div>
    </div>

</nav>
