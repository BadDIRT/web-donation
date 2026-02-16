<nav
    x-data="{ scrolled: false }"
    x-init="window.addEventListener('scroll', () => {
        scrolled = window.scrollY > 20
    })"
    :class="scrolled
        ? 'bg-white shadow-md'
        : 'bg-white/70 backdrop-blur-md'"
    class="fixed top-0 left-0 w-full z-50 transition-all duration-300"
>
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">

        <a href="/" class="text-2xl font-bold text-green-600">
            DonasiKita
        </a>

        <div class="space-x-6 font-medium">
            <a href="{{ route('campaign.index') }}" class="hover:text-green-600">
                Campaign
            </a>

            @auth
                <a href="{{ route('dashboard') }}" class="hover:text-green-600">
                    Dashboard
                </a>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button class="text-red-500 hover:underline">
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

    </div>
</nav>
