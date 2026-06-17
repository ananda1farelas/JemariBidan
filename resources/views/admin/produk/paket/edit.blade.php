@extends('layouts.admin')

@section('title', 'Edit Paket - Jemari Bidan')
@section('page-title', 'Edit Paket')

@section('content')
<div class="max-w-3xl mx-auto">

    <div class="mb-6">
        <a href="{{ route('admin.produk.paket') }}" class="text-slate-500 hover:text-slate-700 text-sm flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.produk.paket.update', $paket->id) }}" method="POST" class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        @csrf
        @method('PUT')
        
        <div class="p-6 border-b border-slate-100">
            <h2 class="text-xl font-bold text-slate-800">Edit Paket</h2>
        </div>

        <div class="p-6 space-y-5">
            {{-- Kategori --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Kategori</label>
                <select name="kategori_id" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition" required>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori_id', $paket->kategori_id) == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Nama --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Nama Paket</label>
                <input type="text" name="nama" value="{{ old('nama', $paket->nama) }}" 
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition"
                       required>
                @error('nama')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Slug --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $paket->slug) }}" 
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition"
                       required>
                @error('slug')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Harga & Durasi --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Harga (Rp)</label>
                    <input type="number" name="harga" value="{{ old('harga', $paket->harga) }}" 
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition"
                           min="0" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Durasi (Menit)</label>
                    <input type="number" name="durasi" value="{{ old('durasi', $paket->durasi) }}" 
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition"
                           min="1" required>
                </div>
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="4" 
                          class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition resize-y">{{ old('deskripsi', $paket->deskripsi) }}</textarea>
            </div>

            {{-- Fitur --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Fitur (satu per baris)</label>
                <textarea name="fitur" rows="5" 
                          class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition resize-y font-mono text-sm">{{ old('fitur', is_array($paket->fitur) ? implode("\n", $paket->fitur) : '') }}</textarea>
                <p class="text-xs text-slate-400 mt-1">Setiap baris akan jadi 1 fitur</p>
            </div>

            {{-- Gambar URL --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">URL Gambar (Opsional)</label>
                <input type="text" name="gambar" value="{{ old('gambar', $paket->gambar) }}" 
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition">
            </div>

            {{-- Aktif --}}
            <div class="flex items-center gap-3">
                <input type="checkbox" name="aktif" id="aktif" value="1" 
                       {{ old('aktif', $paket->aktif) ? 'checked' : '' }}
                       class="w-5 h-5 rounded border-slate-300 text-sky-500 focus:ring-sky-200">
                <label for="aktif" class="text-sm text-slate-700">Paket aktif (tampil di katalog)</label>
            </div>
        </div>

        <div class="p-6 border-t border-slate-100 bg-slate-50 flex gap-3">
            <a href="{{ route('admin.produk.paket') }}" class="px-6 py-2.5 border border-slate-200 text-slate-600 rounded-xl font-medium hover:bg-white transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 bg-sky-500 text-white rounded-xl font-medium hover:bg-sky-600 transition shadow-sm shadow-sky-200">
                Simpan Perubahan
            </button>
        </div>
    </form>

</div>
@endsection