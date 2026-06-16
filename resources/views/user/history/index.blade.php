@extends('layouts.user')

@section('title', 'History Transaksi - Jemari Bidan')
@section('page-title', 'History Transaksi')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Riwayat Transaksi</h2>
        <p class="text-gray-500">Kelola dan pantau status pesanan treatment Anda</p>
    </div>

    {{-- Filter Status --}}
    <div class="flex flex-wrap gap-2">
        <button class="px-4 py-2 rounded-full bg-emerald-500 text-white text-sm font-medium">Semua</button>
        <button class="px-4 py-2 rounded-full bg-white border border-gray-200 text-gray-600 text-sm font-medium hover:bg-gray-50">Menunggu</button>
        <button class="px-4 py-2 rounded-full bg-white border border-gray-200 text-gray-600 text-sm font-medium hover:bg-gray-50">Diproses</button>
        <button class="px-4 py-2 rounded-full bg-white border border-gray-200 text-gray-600 text-sm font-medium hover:bg-gray-50">Selesai</button>
    </div>

    {{-- List Transaksi --}}
    <div class="space-y-4">
        @forelse($transaksis as $trx)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            {{-- Header Card --}}
            <div class="p-5 border-b border-gray-100 flex flex-wrap items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-800">{{ $trx->kode_transaksi }}</p>
                        <p class="text-xs text-gray-500">{{ $trx->tanggal_transaksi->format('d M Y, H:i') }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    {!! $trx->status_badge !!}
                    <span class="text-lg font-bold text-gray-800">{{ $trx->total_formatted }}</span>
                </div>
            </div>

            {{-- Detail Items --}}
            <div class="p-5">
                <div class="space-y-3">
                    @foreach($trx->details as $detail)
                    <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">{{ $detail->paket->nama }}</p>
                                <p class="text-xs text-gray-500">{{ $detail->paket->kategori->nama ?? '' }} × {{ $detail->qty }}</p>
                            </div>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                    </div>
                    @endforeach
                </div>

                {{-- Action --}}
                <div class="mt-4 flex justify-end">
                    <a href="{{ route('user.history.show', $trx->id) }}" 
                    class="text-emerald-600 text-sm font-medium hover:underline flex items-center gap-1">
                        Lihat Detail
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        @empty
            {{-- Empty State (bukan dummy, tapi info belum ada transaksi) --}}
            <div class="text-center py-16 bg-white rounded-2xl border border-gray-100">
                <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-gray-100 flex items-center justify-center">
                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-700 mb-1">Belum Ada Transaksi</h3>
                <p class="text-gray-500 mb-4">Anda belum melakukan pemesanan treatment</p>
                <a href="{{ route('user.katalog') }}" class="inline-flex items-center gap-2 bg-emerald-500 text-white px-6 py-2.5 rounded-full font-medium hover:bg-emerald-600 transition">
                    Lihat Katalog
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
            @endforelse
        </div>

        {{-- Pagination kalo ada data --}}
        @if($transaksis->count() > 0)
        <div class="mt-6">
            {{ $transaksis->links() }}
        </div>
        @endif 
    </div>

</div>
@endsection