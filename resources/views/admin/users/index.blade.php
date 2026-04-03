@extends('layouts.app')

@section('title', 'Kelola User')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- HEADER --}}
            <div class="mb-8">
                <a href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-emerald-600 transition-colors mb-6 group">
                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Dashboard
                </a>

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-500 flex items-center justify-center shadow-lg shadow-blue-500/20">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">Kelola User</h1>
                            <p class="text-slate-500 text-sm mt-0.5">Manajemen akun pengguna platform</p>
                        </div>
                    </div>

                    <a href="{{ route('admin.users.create') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold bg-gradient-to-r from-blue-500 to-indigo-500 text-white hover:from-blue-600 hover:to-indigo-600 shadow-lg shadow-blue-500/20 hover:shadow-blue-500/30 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 9v3m0 0v-3m0 3h-3m-3 0h6m-9 1a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Tambah User
                    </a>
                </div>
            </div>

            {{-- ALERTS --}}
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    class="mb-6 bg-emerald-50 border border-emerald-200 rounded-xl px-5 py-4 flex items-center gap-3">
                    <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="text-sm text-emerald-700 font-medium">{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                    class="mb-6 bg-red-50 border border-red-200 rounded-xl px-5 py-4 flex items-center gap-3">
                    <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <p class="text-sm text-red-700 font-medium">{{ session('error') }}</p>
                </div>
            @endif

            {{-- FILTER BAR --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-4 sm:p-5 mb-6">
                <form method="GET" class="flex flex-col lg:flex-row gap-3">

                    {{-- SEARCH --}}
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="q" value="{{ request('q') }}"
                            placeholder="Cari nama atau email..."
                            class="w-full pl-12 pr-10 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all">
                        @if (request('q'))
                            <a href="{{ request()->fullUrlWithQuery(['q' => '']) }}"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        @endif
                    </div>

                    {{-- FILTERS --}}
                    <div class="flex flex-wrap gap-3">
                        <div class="relative">
                            <select name="role" onchange="this.form.submit()"
                                class="appearance-none pl-4 pr-10 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all cursor-pointer min-w-[150px]">
                                <option value="">Semua Role</option>
                                <option value="donatur" {{ request('role') === 'donatur' ? 'selected' : '' }}>Donatur
                                </option>
                                <option value="pengelola" {{ request('role') === 'pengelola' ? 'selected' : '' }}>Pengelola
                                </option>
                                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>

                        {{-- RESET --}}
                        @if (request()->hasAny(['q', 'role']))
                            <a href="{{ route('admin.users.index') }}"
                                class="px-4 py-3 rounded-xl text-sm font-medium border border-slate-200 text-slate-500 hover:bg-slate-50 hover:text-slate-700 hover:border-slate-300 transition-all flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                <span class="hidden sm:inline">Reset</span>
                            </a>
                        @endif
                    </div>
                </form>

                {{-- ACTIVE FILTER --}}
                @if (request('role'))
                    <div class="flex items-center gap-2 mt-3 pt-3 border-t border-slate-100">
                        <span class="text-xs text-slate-400">Filter aktif:</span>
                        <span
                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-blue-50 text-blue-600 text-xs font-medium">
                            {{ ucfirst(request('role')) }}
                            <a href="{{ request()->fullUrlWithQuery(['role' => '']) }}" class="hover:text-blue-800">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        </span>
                    </div>
                @endif
            </div>

            {{-- SEARCH INFO --}}
            @if (request('q'))
                <div class="flex items-center gap-2 mb-4 text-sm text-slate-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Menampilkan hasil untuk <span
                            class="font-semibold text-slate-700">"{{ request('q') }}"</span></span>
                </div>
            @endif

            {{-- USER LIST --}}
            <div class="space-y-3">

                @forelse($users as $user)
                    <div
                        class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden hover:shadow-md hover:border-blue-100 transition-all duration-200">

                        <div class="p-5 sm:p-6">
                            <div class="flex flex-col sm:flex-row gap-5">

                                {{-- AVATAR & INFO --}}
                                <div class="flex items-center gap-4 flex-1 min-w-0">
                                    <div
                                        class="w-12 h-12 rounded-xl flex items-center justify-center text-lg font-bold flex-shrink-0
                                        {{ $user->role === 'admin' ? 'bg-red-100 text-red-600' : ($user->role === 'pengelola' ? 'bg-violet-100 text-violet-600' : 'bg-blue-100 text-blue-600') }}">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <h3 class="text-base font-bold text-slate-800 truncate">{{ $user->name }}
                                            </h3>
                                            {{-- ROLE BADGE --}}
                                            <span
                                                class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full
                                                {{ $user->role === 'admin' ? 'bg-red-100 text-red-600' : ($user->role === 'pengelola' ? 'bg-violet-100 text-violet-600' : 'bg-slate-100 text-slate-500') }}">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-slate-500 mt-0.5 truncate">{{ $user->email }}</p>
                                        <p class="text-xs text-slate-400 mt-1">ID: {{ $user->id }} •
                                            {{ $user->created_at->translatedFormat('d M Y') }}</p>
                                    </div>
                                </div>

                                {{-- APPROVAL STATUS (HANYA PENGELOLA) --}}
                                @if ($user->role === 'pengelola')
                                    <div class="flex-shrink-0 self-start">
                                        <span
                                            class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider px-3 py-1.5 rounded-xl
                                            {{ $user->is_approved ? 'bg-emerald-100 text-emerald-600' : 'bg-amber-100 text-amber-600' }}">
                                            @if ($user->is_approved)
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                    stroke-width="2.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                                Aktif
                                            @else
                                                <span class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></span>
                                                Pending
                                            @endif
                                        </span>
                                    </div>
                                @endif

                                {{-- ACTIONS --}}
                                <div class="flex sm:flex-col items-center gap-2 flex-shrink-0 sm:pt-1">

                                    {{-- DETAIL BUTTON --}}
                                    <a href="{{ route('admin.users.show', $user) }}"
                                        class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-sm font-medium border border-blue-200 text-blue-600 hover:bg-blue-50 hover:border-blue-300 transition-all w-full sm:w-auto justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span class="hidden sm:inline">Detail</span>
                                    </a>

                                    {{-- EDIT BUTTON --}}
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                        class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-sm font-medium border border-slate-200 text-slate-600 hover:bg-slate-50 hover:border-slate-300 transition-all w-full sm:w-auto justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        <span class="hidden sm:inline">Edit</span>
                                    </a>

                                    {{-- DELETE BUTTON --}}
                                    <button type="button"
                                        onclick="document.getElementById('deleteForm-{{ $user->id }}').classList.remove('hidden')"
                                        class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-sm font-medium border border-red-200 text-red-600 hover:bg-red-50 hover:border-red-300 transition-all w-full sm:w-auto justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <span class="hidden sm:inline">Hapus</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- HIDDEN DELETE FORM --}}
                        <div id="deleteForm-{{ $user->id }}" class="hidden px-6 pb-5">
                            <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                                <p class="text-sm text-red-700 mb-3">
                                    Yakin ingin menghapus user <span class="font-bold">{{ $user->name }}</span>?
                                    Tindakan ini tidak dapat dibatalkan.
                                </p>
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                    class="flex justify-end gap-2">
                                    @csrf @method('DELETE')
                                    <button type="button"
                                        onclick="event.preventDefault(); document.getElementById('deleteForm-{{ $user->id }}').classList.add('hidden')"
                                        class="px-4 py-2 rounded-xl text-sm font-medium border border-slate-200 text-slate-600 hover:bg-slate-100 transition-colors">
                                        Batal
                                    </button>
                                    <button type="submit"
                                        class="px-4 py-2 rounded-xl text-sm font-semibold bg-red-500 hover:bg-red-600 text-white shadow-lg shadow-red-500/20 transition-all">
                                        Ya, Hapus
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                @empty
                    {{-- EMPTY STATE --}}
                    <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                        <div class="px-6 py-20 text-center">
                            <div class="w-20 h-20 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor"
                                    stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>

                            @if (request('q') || request('role'))
                                <h3 class="font-bold text-slate-700 text-lg">Tidak Ditemukan</h3>
                                <p class="text-slate-500 text-sm mt-2 max-w-sm mx-auto">
                                    Tidak ada user dengan filter yang dipilih.
                                </p>
                                <a href="{{ route('admin.users.index') }}"
                                    class="inline-flex items-center gap-2 mt-5 px-5 py-2.5 rounded-xl text-sm font-medium border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Reset Filter
                                </a>
                            @else
                                <h3 class="font-bold text-slate-700 text-lg">Belum Ada User</h3>
                                <p class="text-slate-500 text-sm mt-2 max-w-sm mx-auto">
                                    Belum ada pengguna yang terdaftar di platform.
                                </p>
                                <a href="{{ route('admin.users.create') }}"
                                    class="inline-flex items-center gap-2 mt-5 px-5 py-2.5 rounded-xl text-sm font-semibold bg-blue-500 hover:bg-blue-600 text-white shadow-lg shadow-blue-500/20 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M18 9v3m0 0v-3m0 3h-3m-3 0h6m-9 1a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                    </svg>
                                    Tambah User Baru
                                </a>
                            @endif
                        </div>
                    </div>
                @endforelse

            </div>

            {{-- PAGINATION --}}
            @if ($users->hasPages())
                <div class="mt-8 flex items-center justify-between">
                    <p class="text-sm text-slate-500">
                        Menampilkan
                        <span class="font-semibold text-slate-700">{{ $users->firstItem() }}</span> -
                        <span class="font-semibold text-slate-700">{{ $users->lastItem() }}</span> dari
                        <span class="font-semibold text-slate-700">{{ $users->total() }}</span>
                    </p>

                    <div class="flex items-center gap-1">
                        {{-- PREV --}}
                        @if ($users->onFirstPage())
                            <span
                                class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-300 border border-slate-100 bg-slate-50">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </span>
                        @else
                            <a href="{{ $users->previousPageUrl() }}"
                                class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-600 border border-slate-200 bg-white hover:bg-slate-50 hover:border-slate-300 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>
                        @endif

                        {{-- NUMBERS --}}
                        @php
                            $start = max(1, $users->currentPage() - 1);
                            $end = min($users->lastPage(), $users->currentPage() + 1);
                        @endphp

                        @if ($start > 1)
                            <a href="{{ $users->url(1) }}"
                                class="w-9 h-9 rounded-xl flex items-center justify-center text-sm text-slate-600 border border-slate-200 bg-white hover:bg-slate-50 hover:border-slate-300 transition-all">1</a>
                            @if ($start > 2)
                                <span
                                    class="w-9 h-9 rounded-xl flex items-center justify-center text-sm text-slate-400">...</span>
                            @endif
                        @endif

                        @for ($i = $start; $i <= $end; $i++)
                            @if ($i == $users->currentPage())
                                <span
                                    class="w-9 h-9 rounded-xl flex items-center justify-center text-sm font-bold text-white bg-gradient-to-r from-blue-500 to-indigo-500 shadow-lg shadow-blue-500/20">{{ $i }}</span>
                            @else
                                <a href="{{ $users->url($i) }}"
                                    class="w-9 h-9 rounded-xl flex items-center justify-center text-sm text-slate-600 border border-slate-200 bg-white hover:bg-slate-50 hover:border-slate-300 transition-all">{{ $i }}</a>
                            @endif
                        @endfor

                        @if ($end < $users->lastPage())
                            @if ($end < $users->lastPage() - 1)
                                <span
                                    class="w-9 h-9 rounded-xl flex items-center justify-center text-sm text-slate-400">...</span>
                            @endif
                            <a href="{{ $users->url($users->lastPage()) }}"
                                class="w-9 h-9 rounded-xl flex items-center justify-center text-sm text-slate-600 border border-slate-200 bg-white hover:bg-slate-50 hover:border-slate-300 transition-all">{{ $users->lastPage() }}</a>
                        @endif

                        {{-- NEXT --}}
                        @if ($users->hasMorePages())
                            <a href="{{ $users->nextPageUrl() }}"
                                class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-600 border border-slate-200 bg-white hover:bg-slate-50 hover:border-slate-300 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecall="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        @else
                            <span
                                class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-300 border border-slate-100 bg-slate-50">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </span>
                        @endif
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
