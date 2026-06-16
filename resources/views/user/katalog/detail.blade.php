@extends('layouts.user')

@section('title', $paket->nama . ' - Jemari Bidan')
@section('page-title', 'Detail Paket')

@section('content')
<div class="space-y-6">

    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm text-gray-500">
        <a href="{{ route('user.katalog') }}" class="hover:text-emerald-600">Katalog</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <a href="{{ route('user.katalog.kategori', $kategori->slug) }}" class="hover:text-emerald-600">{{ $kategori->nama }}</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-emerald-600 font-medium">{{ $paket->nama }}</span>
    </div>

    {{-- Detail Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            
            {{-- Left: Image --}}
            <div class="h-64 lg:h-auto bg-gradient-to-br from-emerald-50 to-teal-50 flex items-center justify-center p-8">
                <div class="w-32 h-32 rounded-3xl bg-white flex items-center justify-center shadow-lg">
                    <svg class="w-16 h-16 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
            </div>

            {{-- Right: Info --}}
            <div class="p-8">
                <div class="flex items-center gap-2 mb-3">
                    <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full">
                        {{ $kategori->nama }}
                    </span>
                    @if($paket->durasi > 0)
                    <span class="bg-gray-100 text-gray-600 text-xs font-bold px-3 py-1 rounded-full">
                        {{ $paket->durasi }} menit
                    </span>
                    @endif
                </div>

                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $paket->nama }}</h1>
                <p class="text-gray-500 mb-6">{{ $paket->deskripsi }}</p>

                {{-- Harga --}}
                <div class="mb-6">
                    <span class="text-sm text-gray-500">Harga</span>
                    <div class="text-3xl font-bold text-emerald-600">{{ $paket->harga_formatted }}</div>
                </div>

                {{-- Fitur Lengkap --}}
                <div class="mb-8">
                    <h3 class="font-semibold text-gray-800 mb-3">Fitur Treatment:</h3>
                    <div class="space-y-2">
                        @foreach($paket->fitur as $fitur)
                        <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50">
                            <div class="w-6 h-6 rounded-full bg-emerald-500 flex items-center justify-center flex-shrink-0">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="text-sm text-gray-700">{{ $fitur }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex gap-3">
                    <button onclick="addToCart({{ $paket->id }}, '{{ $paket->nama }}')" 
                                class="flex-1 py-4 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-xl font-bold hover:shadow-lg transition flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah ke Keranjang
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Paket Lainnya --}}
    @if($related->count() > 0)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Paket Lainnya</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($related as $item)
            <a href="{{ route('user.katalog.detail', [$kategori->slug, $item->slug]) }}" 
               class="group p-4 rounded-xl border border-gray-100 hover:border-emerald-200 hover:bg-emerald-50 transition">
                <h4 class="font-semibold text-gray-800 group-hover:text-emerald-600 transition">{{ $item->nama }}</h4>
                <p class="text-sm text-emerald-600 font-bold mt-1">{{ $item->harga_formatted }}</p>
            </a>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection