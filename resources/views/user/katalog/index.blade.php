@extends('layouts.user')

@section('title', 'Katalog Produk - Jemari Bidan')
@section('page-title', 'Katalog Produk')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Katalog Treatment</h2>
        <p class="text-gray-500">Pilih kategori treatment untuk ibu dan si kecil</p>
    </div>

    {{-- Grid Kategori --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($kategoris as $kategori)
        <a href="{{ route('user.katalog.kategori', $kategori->slug) }}" 
           class="group relative overflow-hidden bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300">
            
            {{-- Background Gradient --}}
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-teal-500/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            
            <div class="relative p-6 flex items-center gap-5">
                {{-- Icon --}}
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center shadow-lg flex-shrink-0">
                    @if($kategori->slug === 'mom')
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    @else
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    @endif
                </div>

                {{-- Info --}}
                <div class="flex-1">
                    <div class="flex items-center justify-between mb-1">
                        <h3 class="text-lg font-bold text-gray-800 group-hover:text-emerald-600 transition">{{ $kategori->nama }}</h3>
                        <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-2 py-1 rounded-full">
                            {{ $kategori->pakets_count }} paket
                        </span>
                    </div>
                    <p class="text-sm text-gray-500 line-clamp-2">{{ $kategori->deskripsi }}</p>
                    
                    {{-- Arrow --}}
                    <div class="mt-3 flex items-center text-emerald-600 text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity">
                        Lihat Paket
                        <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>

</div>
@endsection