<nav class="bg-white shadow-md">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <a href="/" class="text-2xl font-bold text-green-600">
            DonasiKita
        </a>

        <div class="space-x-6">
            <a href="{{ route('campaign.index') }}" class="hover:text-green-600">Campaign</a>

            @auth
                <a href="{{ route('dashboard') }}" class="hover:text-green-600">Dashboard</a>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button class="text-red-500">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:text-green-600">Login</a>
                <a href="{{ route('register') }}" class="bg-green-500 text-white px-4 py-2 rounded-xl">Daftar</a>
            @endauth
        </div>
    </div>
</nav>
