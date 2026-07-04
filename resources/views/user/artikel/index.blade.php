@extends('layouts.user')

@section('title', 'Artikel Kesehatan - Jemari Bidan')
@section('page-title', 'Artikel Kesehatan')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Artikel Kesehatan</h2>
        <p class="text-gray-500">Tips dan informasi seputar kesehatan ibu dan anak</p>
    </div>

    {{-- Filter Kategori --}}
    <div class="flex flex-wrap gap-2">
        {{-- Tombol Semua --}}
        <a href="{{ request()->url() }}" 
        class="px-4 py-2 rounded-full text-sm font-medium transition {{ !request('kategori') ? 'bg-emerald-500 text-white' : 'bg-white border border-gray-200 text-gray-600 hover:bg-gray-50' }}">
            Semua ({{ $kategoris['semua'] }})
        </a>

        {{-- Tombol Ibu --}}
        <a href="{{ request()->fullUrlWithQuery(['kategori' => 'ibu']) }}" 
        class="px-4 py-2 rounded-full text-sm font-medium transition {{ request('kategori') == 'ibu' ? 'bg-emerald-500 text-white' : 'bg-white border border-gray-200 text-gray-600 hover:bg-gray-50' }}">
            Ibu ({{ $kategoris['ibu'] }})
        </a>

        {{-- Tombol Bayi --}}
        <a href="{{ request()->fullUrlWithQuery(['kategori' => 'bayi']) }}" 
        class="px-4 py-2 rounded-full text-sm font-medium transition {{ request('kategori') == 'bayi' ? 'bg-emerald-500 text-white' : 'bg-white border border-gray-200 text-gray-600 hover:bg-gray-50' }}">
            Bayi ({{ $kategoris['bayi'] }})
        </a>

        {{-- Tombol Gizi --}}
        <a href="{{ request()->fullUrlWithQuery(['kategori' => 'gizi']) }}" 
        class="px-4 py-2 rounded-full text-sm font-medium transition {{ request('kategori') == 'gizi' ? 'bg-emerald-500 text-white' : 'bg-white border border-gray-200 text-gray-600 hover:bg-gray-50' }}">
            Gizi ({{ $kategoris['gizi'] }})
        </a>
    </div>

    {{-- Grid Artikel --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($artikels as $artikel)
        <a href="{{ route('user.artikel.show', $artikel->slug) }}" class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300">
            {{-- Gambar Placeholder --}}
            <div class="h-48 bg-gradient-to-br from-emerald-50 to-teal-50 flex items-center justify-center relative overflow-hidden">
                <div class="w-16 h-16 rounded-2xl bg-white/80 flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
                <span class="absolute top-3 left-3 bg-white/90 backdrop-blur text-emerald-700 text-xs font-bold px-2 py-1 rounded-lg">
                    {{ ucfirst($artikel->kategori) }}
                </span>
            </div>

            {{-- Content --}}
            <div class="p-5">
                <h3 class="font-bold text-gray-800 mb-2 group-hover:text-emerald-600 transition line-clamp-2">{{ $artikel->judul }}</h3>
                <p class="text-sm text-gray-500 mb-4 line-clamp-3">{{ $artikel->excerpt }}</p>
                
                <div class="flex items-center justify-between text-xs text-gray-400">
                    <span>{{ $artikel->created_at->format('d M Y') }}</span>
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        {{ number_format($artikel->dibaca) }} kali baca
                    </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>

</div>
@endsection