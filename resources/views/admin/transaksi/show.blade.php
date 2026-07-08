@extends('layouts.admin')

@section('title', 'Detail Transaksi - Jemari Bidan')
@section('page-title', 'Detail Transaksi')

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="mb-6">
        <a href="{{ route('admin.transaksi') }}" class="text-slate-500 hover:text-slate-700 text-sm flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Info Transaksi --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-slate-800">{{ $transaksi->kode_transaksi }}</h2>
                        <p class="text-sm text-slate-400 mt-1">{{ $transaksi->tanggal_transaksi->format('d M Y H:i') }}</p>
                    </div>
                    {!! $transaksi->status_badge !!}
                </div>

                {{-- Item Paket --}}
                <div class="p-6">
                    <h3 class="text-sm font-semibold text-slate-600 mb-4">Item Pesanan</h3>
                    <div class="space-y-4">
                        @foreach($transaksi->details as $detail)
                        <div class="flex items-start gap-4 p-4 bg-slate-50 rounded-xl">
                            @if($detail->paket->gambar)
                                <img src="{{ asset($detail->paket->gambar) }}" class="w-16 h-16 rounded-lg object-cover" alt="">
                            @else
                                <div class="w-16 h-16 rounded-lg bg-slate-200 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="flex-1">
                                <div class="font-medium text-slate-800">{{ $detail->paket->nama }}</div>
                                <div class="text-sm text-slate-400">{{ $detail->paket->kategori->nama ?? '' }}</div>
                                <div class="text-sm text-slate-500 mt-1">{{ $detail->qty }}x @ Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</div>
                            </div>
                            <div class="font-semibold text-slate-700">
                                Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Total --}}
                <div class="p-6 border-t border-slate-100 bg-slate-50">
                    <div class="flex justify-between items-center">
                        <span class="text-slate-600">Total Pembayaran</span>
                        <span class="text-2xl font-bold text-slate-800">{{ $transaksi->total_formatted }}</span>
                    </div>
                </div>
            </div>

            {{-- Catatan --}}
            @if($transaksi->catatan)
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <h3 class="text-sm font-semibold text-slate-600 mb-2">Catatan</h3>
                <p class="text-slate-700">{{ $transaksi->catatan }}</p>
            </div>
            @endif
        </div>

        {{-- Info Pelanggan --}}
        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <h3 class="text-sm font-semibold text-slate-600 mb-4">Pelanggan</h3>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-full bg-sky-100 flex items-center justify-center text-sky-600 font-bold text-lg">
                        {{ strtoupper(substr($transaksi->user->nama ?? 'A', 0, 1)) }}
                    </div>
                    <div>
                        <div class="font-medium text-slate-800">{{ $transaksi->user->nama ?? '-' }}</div>
                        <div class="text-sm text-slate-400">{{ $transaksi->user->email ?? '' }}</div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <h3 class="text-sm font-semibold text-slate-600 mb-4">Aksi</h3>
                <a href="{{ route('admin.transaksi.edit', $transaksi->id) }}" class="block w-full px-4 py-3 bg-sky-500 text-white rounded-xl font-medium text-center hover:bg-sky-600 transition mb-3">
                    Update Status
                </a>
                <form action="{{ route('admin.transaksi.destroy', $transaksi->id) }}" method="POST" onsubmit="return confirm('Yakin hapus transaksi ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="block w-full px-4 py-3 border border-red-200 text-red-500 rounded-xl font-medium text-center hover:bg-red-50 transition">
                        Hapus Transaksi
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection