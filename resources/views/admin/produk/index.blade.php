@extends('layouts.admin')

@section('title', 'Kelola Produk - Jemari Bidan')
@section('page-title', 'Kelola Produk')

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Card Kategori --}}
        <a href="{{ route('admin.produk.kategori') }}" class="group bg-white rounded-xl shadow-sm border border-slate-200 p-8 hover:shadow-md hover:border-sky-200 transition">
            <div class="w-14 h-14 bg-sky-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-sky-100 transition">
                <svg class="w-7 h-7 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-1">Kategori Produk</h3>
            <p class="text-sm text-slate-500">Kelompokkan paket ke dalam kategori Mom & Baby Treatment</p>
            <div class="mt-4 flex items-center text-sm text-sky-500 font-medium">
                Kelola
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
        </a>

        {{-- Card Paket --}}
        <a href="{{ route('admin.produk.paket') }}" class="group bg-white rounded-xl shadow-sm border border-slate-200 p-8 hover:shadow-md hover:border-sky-200 transition">
            <div class="w-14 h-14 bg-emerald-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-emerald-100 transition">
                <svg class="w-7 h-7 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-1">Paket Layanan</h3>
            <p class="text-sm text-slate-500">Atur paket treatment dengan harga, durasi & fitur</p>
            <div class="mt-4 flex items-center text-sm text-emerald-500 font-medium">
                Kelola
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
        </a>
    </div>

</div>
@endsection