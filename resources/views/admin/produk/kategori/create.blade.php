@extends('layouts.admin')

@section('title', 'Tambah Kategori - Jemari Bidan')
@section('page-title', 'Tambah Kategori')

@section('content')
<div class="max-w-2xl mx-auto">

    <div class="mb-6">
        <a href="{{ route('admin.produk.kategori') }}" class="text-slate-500 hover:text-slate-700 text-sm flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.produk.kategori.store') }}" method="POST" class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        @csrf
        
        <div class="p-6 border-b border-slate-100">
            <h2 class="text-xl font-bold text-slate-800">Tambah Kategori Baru</h2>
        </div>

        <div class="p-6 space-y-5">
            {{-- Nama --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Nama Kategori</label>
                <input type="text" name="nama" value="{{ old('nama') }}" 
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition"
                       placeholder="Contoh: Mom Treatment" required>
                @error('nama')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Slug --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Slug</label>
                <input type="text" name="slug" value="{{ old('slug') }}" 
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition"
                       placeholder="mom-treatment" required>
                <p class="text-xs text-slate-400 mt-1">Gunakan huruf kecil & tanpa spasi</p>
                @error('slug')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="3" 
                          class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition resize-y"
                          placeholder="Deskripsi singkat kategori...">{{ old('deskripsi') }}</textarea>
            </div>

            {{-- Gambar URL --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">URL Gambar (Opsional)</label>
                <input type="text" name="gambar" value="{{ old('gambar') }}" 
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition"
                       placeholder="https://example.com/gambar.jpg">
            </div>

            {{-- Urutan --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Urutan Tampil</label>
                <input type="number" name="urutan" value="{{ old('urutan', 0) }}" 
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition"
                       min="0">
            </div>
        </div>

        <div class="p-6 border-t border-slate-100 bg-slate-50 flex gap-3">
            <a href="{{ route('admin.produk.kategori') }}" class="px-6 py-2.5 border border-slate-200 text-slate-600 rounded-xl font-medium hover:bg-white transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 bg-sky-500 text-white rounded-xl font-medium hover:bg-sky-600 transition shadow-sm shadow-sky-200">
                Simpan Kategori
            </button>
        </div>
    </form>

</div>
@endsection