@extends('layouts.admin')

@section('title', 'Edit Pengguna - Jemari Bidan')
@section('page-title', 'Edit Pengguna')

@section('content')
<div class="max-w-2xl mx-auto">

    <div class="mb-6">
        <a href="{{ route('admin.pengguna') }}" class="text-slate-500 hover:text-slate-700 text-sm flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.pengguna.update', $user->id) }}" method="POST" class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        @csrf
        @method('PUT')
        
        <div class="p-6 border-b border-slate-100">
            <h2 class="text-xl font-bold text-slate-800">Edit Pengguna</h2>
        </div>

        <div class="p-6 space-y-5">
            {{-- Nama --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" 
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition"
                       required>
                @error('nama')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition"
                       required>
                @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password (Opsional) --}}
            <div class="p-4 bg-amber-50 border border-amber-200 rounded-xl">
                <p class="text-sm text-amber-700 mb-3">Kosongkan password kalau tidak ingin mengubahnya</p>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Password Baru</label>
                        <input type="password" name="password" 
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" 
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition">
                    </div>
                </div>
            </div>
            @error('password')
            <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror

            {{-- No HP --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Nomor HP</label>
                <input type="tel" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" 
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition">
            </div>

            {{-- Alamat --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Alamat</label>
                <textarea name="alamat" rows="3" 
                          class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition resize-y">{{ old('alamat', $user->alamat) }}</textarea>
            </div>

            {{-- Role --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Role</label>
                <select name="role" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition" required>
                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
        </div>

        <div class="p-6 border-t border-slate-100 bg-slate-50 flex gap-3">
            <a href="{{ route('admin.pengguna') }}" class="px-6 py-2.5 border border-slate-200 text-slate-600 rounded-xl font-medium hover:bg-white transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 bg-sky-500 text-white rounded-xl font-medium hover:bg-sky-600 transition shadow-sm shadow-sky-200">
                Simpan Perubahan
            </button>
        </div>
    </form>

</div>
@endsection