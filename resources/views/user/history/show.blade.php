@extends('layouts.user')

@section('title', 'Detail Transaksi - ' . $transaksi->kode_transaksi)
@section('page-title', 'Detail Transaksi')

@section('content')
<div class="space-y-6 max-w-3xl mx-auto">

    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm text-gray-500">
        <a href="{{ route('user.history') }}" class="hover:text-emerald-600">History</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-emerald-600 font-medium">{{ $transaksi->kode_transaksi }}</span>
    </div>

    {{-- Invoice Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        
        {{-- Header Invoice --}}
        <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-emerald-50 to-teal-50">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Kode Transaksi</p>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $transaksi->kode_transaksi }}</h2>
                </div>
                <div class="text-right">
                    {!! $transaksi->status_badge !!}
                    <p class="text-sm text-gray-500 mt-2">{{ $transaksi->tanggal_transaksi->format('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>

        {{-- Info Pelanggan --}}
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-sm font-semibold text-gray-700 mb-3 uppercase tracking-wide">Info Pelanggan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-xs text-gray-500 mb-1">Nama</p>
                    <p class="font-medium text-gray-800">{{ $transaksi->user->nama }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-1">No. HP</p>
                    <p class="font-medium text-gray-800">{{ $transaksi->user->no_hp ?? '-' }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-xs text-gray-500 mb-1">Alamat</p>
                    <p class="font-medium text-gray-800">{{ $transaksi->user->alamat ?? '-' }}</p>
                </div>
            </div>
        </div>

        {{-- Detail Items --}}
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-sm font-semibold text-gray-700 mb-4 uppercase tracking-wide">Detail Pesanan</h3>
            
            <div class="space-y-3">
                @foreach($transaksi->details as $detail)
                <div class="flex items-center justify-between p-4 rounded-xl bg-gray-50 border border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-lg bg-emerald-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">{{ $detail->paket->nama }}</p>
                            <p class="text-xs text-gray-500">{{ $detail->paket->kategori->nama ?? '' }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-medium text-gray-800">{{ $detail->qty }}× Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</p>
                        <p class="text-sm font-bold text-emerald-600">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Total --}}
        <div class="p-6 bg-gray-50">
            <div class="flex items-center justify-between mb-2">
                <span class="text-gray-600">Subtotal</span>
                <span class="font-medium text-gray-800">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
            </div>
            <div class="flex items-center justify-between pt-3 border-t border-gray-200">
                <span class="text-lg font-bold text-gray-800">Total Pembayaran</span>
                <span class="text-2xl font-bold text-emerald-600">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- Catatan --}}
        @if($transaksi->catatan)
        <div class="p-6 border-t border-gray-100">
            <h3 class="text-sm font-semibold text-gray-700 mb-2">Catatan</h3>
            <p class="text-gray-600 text-sm bg-gray-50 p-3 rounded-xl">{{ $transaksi->catatan }}</p>
        </div>
        @endif

    </div>

    {{-- Tombol Kembali --}}
    <div class="flex gap-3">
        <a href="{{ route('user.history') }}" 
           class="flex-1 py-3 border border-gray-200 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition text-center">
            Kembali
        </a>
        <button onclick="window.print()" 
                class="flex-1 py-3 bg-emerald-500 text-white rounded-xl font-medium hover:bg-emerald-600 transition flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
            </svg>
            Cetak Invoice
        </button>
    </div>

</div>
@endsection

@section('styles')
<style>
@media print {
    .sidebar, header, .breadcrumb, button, a {
        display: none !important;
    }
    .main-content {
        margin-left: 0 !important;
    }
}
</style>
@endsection