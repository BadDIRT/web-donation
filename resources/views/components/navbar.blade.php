<nav x-data="{
    scrolled: false,
    openCampaign: false,
    timeout: null,
    mobileOpen: false,
    mobileCampaignOpen: false,
    logoutOpen: false,

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
        <a href="{{ route('home') }}" class="text-2xl font-bold text-green-600">
            DonasiKita
        </a>

        {{-- DESKTOP MENU --}}
        <div class="hidden md:flex items-center space-x-6 font-medium">

            <a href="{{ route('home') }}" class="hover:text-green-600">
                Beranda
            </a>

            {{-- CAMPAIGN DROPDOWN (DESKTOP) --}}
            <div class="relative" @mouseenter="clearTimeout(timeout); openCampaign = true"
                @mouseleave="timeout = setTimeout(() => openCampaign = false, 150)">
                <button class="flex items-center gap-1 hover:text-green-600">
                    Campaign
                    <svg class="w-4 h-4 mt-0.5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="openCampaign" x-transition x-cloak
                    class="absolute left-0 mt-3 w-56 bg-white rounded-xl shadow-lg border overflow-hidden">
                    <a href="{{ route('campaign.index') }}"
                        class="block px-5 py-3 text-sm font-semibold hover:bg-green-50">
                        Semua Campaign
                    </a>

                    <div class="border-t"></div>

                    <template x-for="category in categories" :key="category.slug">
                        <a :href="`{{ route('campaign.index') }}?category=${category.slug}`"
                            class="block px-5 py-3 text-sm hover:bg-green-50" x-text="category.label"></a>
                    </template>
                </div>
            </div>

            @auth
                <a href="{{ route('dashboard') }}" class="hover:text-green-600">
                    Dashboard
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="button" @click="logoutOpen = true" class="text-red-500 hover:underline">
                        Logout
                    </button>

                </form>
            @else
                <a href="{{ route('dashboard') }}" class="hover:text-green-600">
                    Dashboard
                </a>

                <a href="{{ route('login') }}" class="hover:text-green-600">
                    Login
                </a>

                <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl">
                    Daftar
                </a>
            @endauth
        </div>

        {{-- HAMBURGER (MOBILE) --}}
        <button @click="mobileOpen = !mobileOpen" class="md:hidden text-gray-700 focus:outline-none">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
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

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="button" @click="logoutOpen = true" class="text-red-500 py-2">
                        Logout
                    </button>

                </form>
            @else
                <a href="{{ route('dashboard') }}" class="block py-2 hover:text-green-600">
                    Dashboard
                </a>
                
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
