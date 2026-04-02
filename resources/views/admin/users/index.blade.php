@extends('layouts.app')

@section('title', 'Kelola User')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Kelola User</h1>
                    <p class="text-gray-500 mt-1">Total {{ $users->total() }} pengguna terdaftar</p>
                </div>
                <a href="{{ route('admin.users.create') }}"
                    class="bg-green-500 hover:bg-green-600 text-white px-5 py-3 rounded-xl text-sm font-semibold transition w-fit">
                    + Tambah User Baru
                </a>
            </div>

            {{-- ALERT --}}
            @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 rounded-xl p-4">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4">
                    {{ session('error') }}
                </div>
            @endif

            {{-- FILTER & SEARCH --}}
            <div class="bg-white rounded-2xl shadow-sm p-5 mb-6 border">
                <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col md:flex-row gap-4">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama atau email..."
                        class="w-full md:w-1/2 border rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-500 focus:outline-none">

                    <select name="role" onchange="this.form.submit()"
                        class="border rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-green-500 focus:outline-none">
                        <option value="">Semua Role</option>
                        <option value="donatur" {{ request('role') === 'donatur' ? 'selected' : '' }}>Donatur</option>
                        <option value="pengelola" {{ request('role') === 'pengelola' ? 'selected' : '' }}>Pengelola</option>
                        <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>

                    @if (request()->hasAny(['q', 'role']))
                        <a href="{{ route('admin.users.index') }}"
                            class="text-sm text-red-500 hover:underline flex items-center gap-1">
                            Reset Filter
                        </a>
                    @endif
                </form>
            </div>

            {{-- TABLE --}}
            <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-gray-600">
                            <tr>
                                <th class="py-3 px-5 text-left">Nama / Email</th>
                                <th class="py-3 px-5 text-center">Role</th>
                                <th class="py-3 px-5 text-center">Status</th>
                                <th class="py-3 px-5 text-center">Terdaftar</th>
                                <th class="py-3 px-5 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="border-t hover:bg-gray-50 transition">
                                    <td class="py-4 px-5">
                                        <p class="font-semibold text-gray-800">{{ $user->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                    </td>
                                    <td class="py-4 px-5 text-center">
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-medium 
                                            {{ $user->role === 'admin' ? 'bg-red-100 text-red-700' : ($user->role === 'pengelola' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700') }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-5 text-center">
                                        @if ($user->role === 'pengelola')
                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-medium 
                                                {{ $user->is_approved ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                                {{ $user->is_approved ? 'Approved' : 'Pending' }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-5 text-center text-gray-500">
                                        {{ $user->created_at->format('d M Y') }}
                                    </td>
                                    <td class="py-4 px-5 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.users.edit', $user) }}"
                                                class="p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition"
                                                title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition"
                                                    title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        stroke-width="2" viewBox="0 0 24 24">
                                                        <path
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-10 text-gray-500">Tidak ada data user.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-5 border-t">
                    {{ $users->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
