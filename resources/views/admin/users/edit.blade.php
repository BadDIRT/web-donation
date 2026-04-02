@extends('layouts.auth')

@section('title', 'Edit User')

@section('content')
    <div class="max-w-xl mx-auto py-10">
        <div class="bg-white p-6 rounded-2xl shadow space-y-5">
            <h1 class="text-xl font-bold">Edit User: {{ $user->name }}</h1>

            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-5">
                @csrf @method('PUT')

                <div>
                    <label class="text-sm font-medium">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full border rounded-xl p-3 mt-1" required>
                    @error('name')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-sm font-medium">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full border rounded-xl p-3 mt-1" required>
                    @error('email')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-sm font-medium">Password <span class="text-gray-400 font-normal">(Kosongkan jika
                            tidak ingin diubah)</span></label>
                    <input type="password" name="password" class="w-full border rounded-xl p-3 mt-1">
                    @error('password')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-sm font-medium">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="w-full border rounded-xl p-3 mt-1">
                </div>

                <div>
                    <label class="text-sm font-medium">Role</label>
                    <select name="role" class="w-full border rounded-xl p-3 mt-1" required>
                        <option value="donatur" {{ old('role', $user->role) === 'donatur' ? 'selected' : '' }}>Donatur
                        </option>
                        <option value="pengelola" {{ old('role', $user->role) === 'pengelola' ? 'selected' : '' }}>Pengelola
                        </option>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3 pt-2">
                    <a href="{{ route('admin.users.index') }}"
                        class="flex-1 text-center border py-3 rounded-xl font-semibold text-gray-700 hover:bg-gray-50 transition">Batal</a>
                    <button type="submit"
                        class="flex-1 bg-green-500 hover:bg-green-600 text-white py-3 rounded-xl font-semibold transition">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
@endsection
