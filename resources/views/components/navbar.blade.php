<nav x-data="{
    scrolled: false,
    openCampaign: false,
    timeout: null,
    mobileOpen: false,
    mobileCampaignOpen: false,
    logoutOpen: false,
    notificationOpen: false,
    profileOpen: false,

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
                <div class="flex justify-center mb-4">
                    <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-center">Konfirmasi Logout</h2>
                <p class="text-sm text-gray-500 text-center mt-2">
                    Apakah kamu yakin ingin keluar dari akun ini?
                </p>
                <div class="flex gap-3 mt-6">
                    <button @click="logoutOpen = false"
                        class="w-1/2 border rounded-xl py-2 hover:bg-gray-50">Batal</button>
                    <form action="{{ route('logout') }}" method="POST" class="w-1/2">
                        @csrf
                        <button class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-xl">Logout</button>
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

            <a href="{{ route('home') }}" class="hover:text-green-600">Beranda</a>

            {{-- CAMPAIGN DROPDOWN --}}
            <div class="relative" @mouseenter="clearTimeout(timeout); openCampaign = true"
                @mouseleave="timeout = setTimeout(() => openCampaign = false, 150)">
                <button class="flex items-center gap-1.5 px-3 py-2 hover:text-green-600 transition-all duration-150"
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
                <a href="{{ route('dashboard') }}" class="hover:text-green-600">Dashboard</a>

                {{-- NOTIFICATION DROPDOWN --}}
                <div class="relative" @mouseenter="clearTimeout(timeout); notificationOpen = true"
                    @mouseleave="timeout = setTimeout(() => notificationOpen = false, 150)">
                    <button @click="notificationOpen = !notificationOpen"
                        class="relative p-2 rounded-xl hover:bg-slate-100 focus:outline-none transition-colors duration-150"
                        :class="notificationOpen && 'bg-slate-100'">
                        <svg class="w-[22px] h-[22px] text-slate-600 transition-colors"
                            :class="notificationOpen && 'text-emerald-600'" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 17h5l-1.4-1.4A2 2 0 0118 14V11a6 6 0 00-12 0v3a2 2 0 01-.6 1.4L4 17h5m6 0a3 3 0 11-6 0" />
                        </svg>
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

                    <div x-show="notificationOpen" @click.outside="notificationOpen = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 -translate-y-1 scale-95" x-cloak
                        class="absolute right-0 mt-2.5 w-96 bg-white rounded-2xl shadow-xl shadow-black/10 border border-slate-200/80 overflow-hidden z-50 origin-top-right">
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
                        <div class="max-h-[400px] overflow-y-auto divide-y divide-slate-100">
                            @forelse($notifications as $notif)
                                <a href="{{ route('notifications.read', $notif->id) }}"
                                    class="flex gap-3 px-5 py-4 text-sm transition-colors duration-100
                              {{ !$notif->is_read ? 'bg-emerald-50/40 hover:bg-emerald-50' : 'hover:bg-slate-50' }}">
                                    <div
                                        class="w-9 h-9 rounded-xl flex-shrink-0 flex items-center justify-center mt-0.5
                            @if (str_contains($notif->type, 'approve') ||
                                    str_contains($notif->type, 'success') ||
                                    str_contains($notif->type, 'ended')) bg-emerald-100
                            @elseif(str_contains($notif->type, 'reject') || str_contains($notif->type, 'failed')) bg-red-100
                            @elseif(str_contains($notif->type, 'request') ||
                                    str_contains($notif->type, 'pending') ||
                                    str_contains($notif->type, 'submitted')) bg-amber-100
                            @elseif(str_contains($notif->type, 'withdraw') || str_contains($notif->type, 'income'))
    bg-blue-100
@elseif(str_contains($notif->type, 'deleted'))
    bg-slate-200
@elseif(str_contains($notif->type, 'profile') || str_contains($notif->type, 'password'))
bg-purple-100
@else
bg-slate-100 @endif">
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
                                        @elseif(str_contains($notif->type, 'deleted'))
                                            <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        @elseif(str_contains($notif->type, 'profile') || str_contains($notif->type, 'password'))
                                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        @endif
                                    </div>
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

                {{-- ============================================= --}}
                {{-- PROFILE DROPDOWN (DESKTOP) --}}
                {{-- ============================================= --}}
                <div class="relative" @mouseenter="clearTimeout(timeout); profileOpen = true"
                    @mouseleave="timeout = setTimeout(() => profileOpen = false, 150)">

                    <button @click="profileOpen = !profileOpen"
                        class="flex items-center gap-2.5 pl-1.5 pr-3 py-1.5 rounded-xl hover:bg-slate-100 focus:outline-none transition-colors duration-150"
                        :class="profileOpen && 'bg-slate-100'">

                        {{-- AVATAR: FOTO ATAU INITIAL --}}
                        @if (Auth::user()->profile_photo_path)
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"
                                class="w-8 h-8 rounded-lg object-cover shadow-sm">
                        @else
                            <div
                                class="w-8 h-8 rounded-lg bg-gradient-to-br {{ Auth::user()->role_color }} flex items-center justify-center shadow-sm">
                                <span class="text-xs font-bold text-white">{{ Auth::user()->initial }}</span>
                            </div>
                        @endif

                        <span class="text-sm font-medium text-slate-700 hidden lg:block max-w-[120px] truncate">
                            {{ Auth::user()->name }}
                        </span>

                        <svg class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200"
                            :class="profileOpen && 'rotate-180'" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="profileOpen" @click.outside="profileOpen = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 -translate-y-1 scale-95" x-cloak
                        class="absolute right-0 mt-2.5 w-72 bg-white rounded-2xl shadow-xl shadow-black/10 border border-slate-200/80 overflow-hidden z-50 origin-top-right">

                        {{-- HEADER CARD --}}
                        <a href="{{ route('profile.edit') }}"
                            class="block px-5 py-4 bg-gradient-to-br from-slate-50 to-slate-100/50 border-b border-slate-100 hover:from-emerald-50/30 hover:to-emerald-100/30 transition-colors duration-200">
                            <div class="flex items-center gap-3.5">
                                @if (Auth::user()->profile_photo_path)
                                    <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"
                                        class="w-12 h-12 rounded-xl object-cover shadow-md">
                                @else
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br {{ Auth::user()->role_color }} flex items-center justify-center shadow-md">
                                        <span class="text-lg font-bold text-white">{{ Auth::user()->initial }}</span>
                                    </div>
                                @endif

                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center gap-1.5">
                                        <h4 class="text-sm font-bold text-slate-800 truncate">{{ Auth::user()->name }}
                                        </h4>
                                        <svg class="w-3 h-3 text-slate-400 flex-shrink-0" fill="none"
                                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </div>
                                    <p class="text-xs text-slate-500 truncate mt-0.5">{{ Auth::user()->email }}</p>

                                    <span
                                        class="inline-flex items-center gap-1 mt-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ Auth::user()->role_badge_color }}">
                                        @if (Auth::user()->role === 'admin')
                                            <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @elseif(Auth::user()->role === 'pengelola')
                                            <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                                            </svg>
                                        @else
                                            <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                        {{ ucfirst(Auth::user()->role) }}
                                    </span>
                                </div>
                            </div>

                            @if (Auth::user()->role === 'pengelola' && !Auth::user()->is_approved)
                                <div
                                    class="mt-3 flex items-center gap-2 px-3 py-2 bg-amber-50 border border-amber-200/60 rounded-lg">
                                    <svg class="w-3.5 h-3.5 text-amber-500 flex-shrink-0" fill="none"
                                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-[10px] font-semibold text-amber-700">Menunggu verifikasi admin</span>
                                </div>
                            @elseif(Auth::user()->role === 'pengelola' && Auth::user()->is_approved)
                                <div
                                    class="mt-3 flex items-center gap-2 px-3 py-2 bg-emerald-50 border border-emerald-200/60 rounded-lg">
                                    <svg class="w-3.5 h-3.5 text-emerald-500 flex-shrink-0" fill="none"
                                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    <span class="text-[10px] font-semibold text-emerald-700">Terverifikasi</span>
                                </div>
                            @endif
                        </a>

                        {{-- MENU LINKS --}}
                        <div class="py-2">
                            {{-- ✅ EDIT PROFILE (BARU) --}}
                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center gap-3 px-5 py-2.5 text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-800 transition-colors duration-150 group">
                                <div
                                    class="w-7 h-7 rounded-lg bg-purple-100 group-hover:bg-purple-200 flex items-center justify-center transition-colors">
                                    <svg class="w-3.5 h-3.5 text-purple-500" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                Edit Profile
                            </a>

                            <a href="{{ route('dashboard') }}"
                                class="flex items-center gap-3 px-5 py-2.5 text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-800 transition-colors duration-150 group">
                                <div
                                    class="w-7 h-7 rounded-lg bg-slate-100 group-hover:bg-slate-200 flex items-center justify-center transition-colors">
                                    <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </div>
                                Dashboard
                            </a>

                            <a href="{{ route('my.donations') }}"
                                class="flex items-center gap-3 px-5 py-2.5 text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-800 transition-colors duration-150 group">
                                <div
                                    class="w-7 h-7 rounded-lg bg-slate-100 group-hover:bg-slate-200 flex items-center justify-center transition-colors">
                                    <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                Donasi Saya
                            </a>

                            <a href="{{ route('admin.banks.manage') }}"
                                class="flex items-center gap-3 px-5 py-2.5 text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-800 transition-colors duration-150 group">
                                <div
                                    class="w-7 h-7 rounded-lg bg-slate-100 group-hover:bg-slate-200 flex items-center justify-center transition-colors">
                                    <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                </div>
                                Kelola Rekening
                            </a>

                            @if (Auth::user()->role === 'donatur')
                                <a href="{{ route('pengelola.terms') }}"
                                    class="flex items-center gap-3 px-5 py-2.5 text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-800 transition-colors duration-150 group">
                                    <div
                                        class="w-7 h-7 rounded-lg bg-slate-100 group-hover:bg-slate-200 flex items-center justify-center transition-colors">
                                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                        </svg>
                                    </div>
                                    Jadikan Pengelola
                                </a>
                            @endif
                        </div>

                        {{-- LOGOUT --}}
                        <div class="border-t border-slate-100 py-2">
                            <button @click="logoutOpen = true; profileOpen = false"
                                class="flex items-center gap-3 w-full px-5 py-2.5 text-sm text-red-500 hover:bg-red-50 transition-colors duration-150 group">
                                <div
                                    class="w-7 h-7 rounded-lg bg-red-50 group-hover:bg-red-100 flex items-center justify-center transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                </div>
                                Keluar
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="hover:text-green-600">Login</a>
                <a href="{{ route('register') }}"
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl">Daftar</a>
            @endauth
        </div>

        {{-- HAMBURGER --}}
        <button @click="mobileOpen = !mobileOpen" class="relative md:hidden text-gray-700 focus:outline-none">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            @if ($unreadCount > 0)
                <span
                    class="absolute -top-1 -right-1 bg-red-500 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">{{ $unreadCount }}</span>
            @endif
        </button>
    </div>

    {{-- MOBILE MENU --}}
    <div x-show="mobileOpen" x-transition x-cloak class="md:hidden bg-white border-t">
        <div class="px-4 py-4 space-y-1 font-medium max-h-[85vh] overflow-y-auto">

            @auth
                {{-- MOBILE PROFILE CARD --}}
                <a href="{{ route('profile.edit') }}"
                    class="block mb-4 p-4 bg-gradient-to-br from-slate-50 to-slate-100/50 rounded-2xl border border-slate-200/60 hover:from-emerald-50/30 hover:to-emerald-100/30 transition-colors">
                    <div class="flex items-center gap-3.5">
                        @if (Auth::user()->profile_photo_path)
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"
                                class="w-14 h-14 rounded-xl object-cover shadow-lg">
                        @else
                            <div
                                class="w-14 h-14 rounded-xl bg-gradient-to-br {{ Auth::user()->role_color }} flex items-center justify-center shadow-lg">
                                <span class="text-xl font-bold text-white">{{ Auth::user()->initial }}</span>
                            </div>
                        @endif

                        <div class="min-w-0 flex-1">
                            <div class="flex items-center gap-1.5">
                                <h4 class="text-base font-bold text-slate-800 truncate">{{ Auth::user()->name }}</h4>
                                <svg class="w-3.5 h-3.5 text-slate-400 flex-shrink-0" fill="none"
                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </div>
                            <p class="text-xs text-slate-500 truncate mt-0.5">{{ Auth::user()->email }}</p>
                            <span
                                class="inline-flex items-center gap-1 mt-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ Auth::user()->role_badge_color }}">
                                @if (Auth::user()->role === 'admin')
                                    <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                            clip-rule="evenodd" />
                                    </svg>
                                @elseif(Auth::user()->role === 'pengelola')
                                    <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                                    </svg>
                                @else
                                    <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                            clip-rule="evenodd" />
                                    </svg>
                                @endif
                                {{ ucfirst(Auth::user()->role) }}
                            </span>
                        </div>
                    </div>

                    @if (Auth::user()->role === 'pengelola' && !Auth::user()->is_approved)
                        <div
                            class="mt-3 flex items-center gap-2 px-3 py-2 bg-amber-50 border border-amber-200/60 rounded-lg">
                            <svg class="w-3.5 h-3.5 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-[10px] font-semibold text-amber-700">Menunggu verifikasi admin</span>
                        </div>
                    @elseif(Auth::user()->role === 'pengelola' && Auth::user()->is_approved)
                        <div
                            class="mt-3 flex items-center gap-2 px-3 py-2 bg-emerald-50 border border-emerald-200/60 rounded-lg">
                            <svg class="w-3.5 h-3.5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <span class="text-[10px] font-semibold text-emerald-700">Terverifikasi</span>
                        </div>
                    @endif
                </a>

                <div class="border-t border-slate-100 pt-3"></div>
            @endauth

            <a href="{{ route('home') }}" class="block py-2.5 hover:text-green-600">Beranda</a>

            {{-- MOBILE CAMPAIGN --}}
            <div>
                <button @click="mobileCampaignOpen = !mobileCampaignOpen"
                    class="flex justify-between items-center w-full py-2.5 hover:text-green-600">
                    Campaign
                    <svg class="w-4 h-4 transition" :class="mobileCampaignOpen ? 'rotate-180' : ''" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="mobileCampaignOpen" x-transition class="pl-4 mt-1 space-y-1.5">
                    <a href="{{ route('campaign.index') }}" class="block text-sm py-1.5 hover:text-green-600">Semua
                        Campaign</a>
                    <template x-for="category in categories" :key="category.slug">
                        <a :href="`{{ route('campaign.index') }}?category=${category.slug}`"
                            class="block text-sm py-1.5 hover:text-green-600" x-text="category.label"></a>
                    </template>
                </div>
            </div>

            @auth
                <div class="border-t border-slate-100 pt-3 mt-3"></div>

                {{-- ✅ EDIT PROFILE (BARU) --}}
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 py-2.5 hover:text-green-600">
                    <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Edit Profile
                </a>

                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 py-2.5 hover:text-green-600">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('my.donations') }}" class="flex items-center gap-2.5 py-2.5 hover:text-green-600">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Donasi Saya
                </a>

                <a href="{{ route('admin.banks.manage') }}"
                    class="flex items-center gap-2.5 py-2.5 hover:text-green-600">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    Kelola Rekening
                </a>

                @if (Auth::user()->role === 'donatur')
                    <a href="{{ route('pengelola.terms') }}"
                        class="flex items-center gap-2.5 py-2.5 hover:text-green-600">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Jadikan Pengelola
                    </a>
                @endif

                <a href="{{ route('notifications.index') }}"
                    class="flex items-center justify-between py-2.5 {{ $unreadCount > 0 ? 'text-green-600 font-semibold' : '' }}">
                    <span class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 {{ $unreadCount > 0 ? 'text-green-500' : 'text-slate-400' }}" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        Notifikasi
                    </span>
                    @if ($unreadCount > 0)
                        <span
                            class="bg-red-500 text-white text-[10px] px-2 py-0.5 rounded-full font-bold">{{ $unreadCount }}</span>
                    @endif
                </a>

                <div class="border-t border-slate-100 pt-3 mt-3"></div>

                <button @click="logoutOpen = true; mobileOpen = false"
                    class="flex items-center gap-2.5 py-2.5 text-red-500 w-full">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Keluar
                </button>
            @else
                <div class="border-t border-slate-100 pt-3 mt-3"></div>
                <a href="{{ route('login') }}" class="block py-2.5 hover:text-green-600">Login</a>
                <a href="{{ route('register') }}"
                    class="block text-center bg-green-500 hover:bg-green-600 text-white py-2.5 rounded-xl font-medium">Daftar</a>
            @endauth

        </div>
    </div>
</nav>
