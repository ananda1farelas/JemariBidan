@extends('layouts.user')

@section('title', 'Riwayat Transaksi - Jemari Bidan')
@section('page-title', 'Riwayat Transaksi')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800">Riwayat Pesanan</h2>
        <p class="text-gray-500 mt-1">Lihat status dan detail treatment Anda</p>
    </div>

    @if(session('success'))
    <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl">
        {{ session('success') }}
    </div>
    @endif

    <div class="space-y-4">
        @forelse($transaksis as $transaksi)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <div class="font-mono font-semibold text-gray-800">{{ $transaksi->kode_transaksi }}</div>
                        <div class="text-sm text-gray-400 mt-1">{{ $transaksi->tanggal_transaksi->format('d M Y H:i') }}</div>
                    </div>
                    {!! $transaksi->status_badge !!}
                </div>

                <div class="space-y-2 mb-4">
                    @foreach($transaksi->details as $detail)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">{{ $detail->paket->nama }} × {{ $detail->qty }}</span>
                        <span class="text-gray-800">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                    </div>
                    @endforeach
                </div>

                <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                    <span class="text-gray-500">Total</span>
                    <span class="font-bold text-gray-800">{{ $transaksi->total_formatted }}</span>
                </div>
            </div>
            
            <div class="px-6 py-3 bg-gray-50 border-t border-gray-100">
                <a href="{{ route('user.history.show', $transaksi->id) }}" class="text-emerald-600 text-sm font-medium hover:text-emerald-700">
                    Lihat Detail →
                </a>
            </div>
        </div>
        @empty
        <div class="text-center py-12 text-gray-400">
            <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            <p>Belum ada pesanan</p>
            <a href="{{ route('user.katalog') }}" class="text-emerald-600 text-sm mt-2 inline-block">Pilih Treatment</a>
        </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $transaksis->links() }}
    </div>

</div>
@endsection