@extends('layouts.admin')

@section('title', 'Tambah Artikel - Jemari Bidan')
@section('page-title', 'Tambah Artikel')

@section('content')
<div class="max-w-3xl mx-auto">

    <div class="mb-6">
        <a href="{{ route('admin.artikel') }}" class="text-slate-500 hover:text-slate-700 text-sm flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.artikel.store') }}" method="POST" class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        @csrf
        
        <div class="p-6 border-b border-slate-100">
            <h2 class="text-xl font-bold text-slate-800">Tambah Artikel Baru</h2>
        </div>

        <div class="p-6 space-y-5">
            {{-- Judul --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Judul Artikel</label>
                <input type="text" name="judul" value="{{ old('judul') }}" 
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition"
                       placeholder="Masukkan judul artikel" required>
                @error('judul')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kategori --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Kategori</label>
                <select name="kategori" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition" required>
                    <option value="">Pilih Kategori</option>
                    <option value="ibu" {{ old('kategori') == 'ibu' ? 'selected' : '' }}>Ibu</option>
                    <option value="bayi" {{ old('kategori') == 'bayi' ? 'selected' : '' }}>Bayi</option>
                    <option value="gizi" {{ old('kategori') == 'gizi' ? 'selected' : '' }}>Gizi</option>
                    <option value="umum" {{ old('kategori') == 'umum' ? 'selected' : '' }}>Umum</option>
                </select>
                @error('kategori')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Konten --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Konten</label>
                <textarea name="konten" rows="10" 
                          class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition resize-y"
                          placeholder="Tulis konten artikel..." required>{{ old('konten') }}</textarea>
                @error('konten')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Publish --}}
            <div class="flex items-center gap-3">
                <input type="checkbox" name="publish" id="publish" value="1" checked 
                       class="w-5 h-5 rounded border-slate-300 text-sky-500 focus:ring-sky-200">
                <label for="publish" class="text-sm text-slate-700">Publish artikel</label>
            </div>
        </div>

        <div class="p-6 border-t border-slate-100 bg-slate-50 flex gap-3">
            <a href="{{ route('admin.artikel') }}" class="px-6 py-2.5 border border-slate-200 text-slate-600 rounded-xl font-medium hover:bg-white transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 bg-sky-500 text-white rounded-xl font-medium hover:bg-sky-600 transition">
                Simpan Artikel
            </button>
        </div>
    </form>

</div>
@endsection