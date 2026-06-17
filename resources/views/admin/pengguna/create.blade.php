@extends('layouts.admin')

@section('title', 'Tambah Pengguna - Jemari Bidan')
@section('page-title', 'Tambah Pengguna')

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

    <form action="{{ route('admin.pengguna.store') }}" method="POST" class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        @csrf
        
        <div class="p-6 border-b border-slate-100">
            <h2 class="text-xl font-bold text-slate-800">Tambah Pengguna Baru</h2>
        </div>

        <div class="p-6 space-y-5">
            {{-- Nama --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama') }}" 
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition"
                       required>
                @error('nama')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" 
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition"
                       required>
                @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                    <input type="password" name="password" 
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition"
                           required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" 
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition"
                           required>
                </div>
            </div>
            @error('password')
            <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror

            {{-- No HP --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Nomor HP</label>
                <input type="tel" name="no_hp" value="{{ old('no_hp') }}" 
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition"
                       placeholder="081234567890">
            </div>

            {{-- Alamat --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Alamat</label>
                <textarea name="alamat" rows="3" 
                          class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition resize-y"
                          placeholder="Alamat lengkap...">{{ old('alamat') }}</textarea>
            </div>

            {{-- Role --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Role</label>
                <select name="role" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition" required>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
        </div>

        <div class="p-6 border-t border-slate-100 bg-slate-50 flex gap-3">
            <a href="{{ route('admin.pengguna') }}" class="px-6 py-2.5 border border-slate-200 text-slate-600 rounded-xl font-medium hover:bg-white transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 bg-sky-500 text-white rounded-xl font-medium hover:bg-sky-600 transition shadow-sm shadow-sky-200">
                Simpan Pengguna
            </button>
        </div>
    </form>

</div>
@endsection