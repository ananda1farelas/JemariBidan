@extends('layouts.user')

@section('title', $kategori->nama . ' - Katalog Produk')
@section('page-title', $kategori->nama)

@section('content')
<div class="space-y-6">

    {{-- Breadcrumb + Header --}}
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
            <a href="{{ route('user.katalog') }}" class="hover:text-emerald-600">Katalog</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-emerald-600 font-medium">{{ $kategori->nama }}</span>
        </div>
        <h2 class="text-2xl font-bold text-gray-800">{{ $kategori->nama }}</h2>
        <p class="text-gray-500 mt-1">{{ $kategori->deskripsi }}</p>
    </div>

    {{-- Grid Paket --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($kategori->pakets as $paket)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 flex flex-col">
            
            {{-- Image Placeholder --}}
            <div class="h-48 bg-gradient-to-br from-emerald-50 to-teal-50 flex items-center justify-center relative">
                <div class="w-20 h-20 rounded-2xl bg-white/80 flex items-center justify-center shadow-sm">
                    <svg class="w-10 h-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                {{-- Badge durasi --}}
                @if($paket->durasi > 0)
                <span class="absolute top-3 right-3 bg-white/90 backdrop-blur text-gray-700 text-xs font-medium px-2 py-1 rounded-lg shadow-sm">
                    {{ $paket->durasi }} menit
                </span>
                @endif
            </div>

            {{-- Content --}}
            <div class="p-5 flex-1 flex flex-col">
                <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $paket->nama }}</h3>
                <p class="text-sm text-gray-500 mb-3 line-clamp-2">{{ $paket->deskripsi }}</p>
                
                {{-- Fitur --}}
                @if($paket->fitur && count($paket->fitur) > 0)
                <div class="space-y-1 mb-4 flex-1">
                    @foreach(array_slice($paket->fitur, 0, 3) as $fitur)
                    <div class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-xs text-gray-600">{{ $fitur }}</span>
                    </div>
                    @endforeach
                    @if(count($paket->fitur) > 3)
                    <p class="text-xs text-emerald-600 font-medium pl-6">+{{ count($paket->fitur) - 3 }} fitur lainnya</p>
                    @endif
                </div>
                @endif

                {{-- Price & Action --}}
                <div class="pt-4 border-t border-gray-100">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xl font-bold text-emerald-600">{{ $paket->harga_formatted }}</span>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('user.katalog.detail', [$kategori->slug, $paket->slug]) }}" 
                           class="flex-1 py-2.5 border border-emerald-500 text-emerald-600 rounded-xl text-sm font-medium hover:bg-emerald-50 transition text-center">
                            Detail
                        </a>
                        <button onclick="addToCart({{ $paket->id }}, '{{ $paket->nama }}')" 
                                class="flex-1 py-2.5 bg-emerald-500 text-white rounded-xl text-sm font-medium hover:bg-emerald-600 transition flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Pesan
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection