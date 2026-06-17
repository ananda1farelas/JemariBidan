@extends('layouts.admin')

@section('title', 'Detail Pengguna - Jemari Bidan')
@section('page-title', 'Detail Pengguna')

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="mb-6">
        <a href="{{ route('admin.pengguna') }}" class="text-slate-500 hover:text-slate-700 text-sm flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Info Pengguna --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-6 text-center border-b border-slate-100">
                    <div class="w-20 h-20 rounded-full bg-sky-100 flex items-center justify-center text-sky-600 font-bold text-2xl mx-auto mb-3">
                        {{ $user->avatar }}
                    </div>
                    <h2 class="text-xl font-bold text-slate-800">{{ $user->nama }}</h2>
                    <div class="mt-2">{!! $user->role_badge !!}</div>
                </div>
                
                <div class="p-6 space-y-4">
                    <div>
                        <label class="text-xs text-slate-400 uppercase tracking-wide">Email</label>
                        <p class="text-slate-700 font-medium">{{ $user->email }}</p>
                    </div>
                    <div>
                        <label class="text-xs text-slate-400 uppercase tracking-wide">No HP</label>
                        <p class="text-slate-700 font-medium">{{ $user->no_hp ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="text-xs text-slate-400 uppercase tracking-wide">Alamat</label>
                        <p class="text-slate-700">{{ $user->alamat ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="text-xs text-slate-400 uppercase tracking-wide">Bergabung</label>
                        <p class="text-slate-700">{{ $user->created_at->format('d M Y') }}</p>
                    </div>
                </div>

                <div class="p-4 border-t border-slate-100 bg-slate-50">
                    <a href="{{ route('admin.pengguna.edit', $user->id) }}" class="block w-full px-4 py-2.5 bg-sky-500 text-white rounded-xl font-medium text-center hover:bg-sky-600 transition">
                        Edit Pengguna
                    </a>
                </div>
            </div>
        </div>

        {{-- Statistik & Riwayat --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Stats --}}
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <div class="text-3xl font-bold text-slate-800">{{ $totalTransaksi }}</div>
                    <div class="text-sm text-slate-500 mt-1">Total Transaksi</div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <div class="text-3xl font-bold text-emerald-600">Rp {{ number_format($totalBelanja, 0, ',', '.') }}</div>
                    <div class="text-sm text-slate-500 mt-1">Total Belanja</div>
                </div>
            </div>

            {{-- Riwayat Transaksi --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800">Riwayat Transaksi</h3>
                </div>
                
                @if($user->transaksis->count() > 0)
                <div class="divide-y divide-slate-100">
                    @foreach($user->transaksis as $transaksi)
                    <div class="p-4 flex items-center justify-between hover:bg-slate-50 transition">
                        <div>
                            <div class="font-mono font-medium text-slate-800">{{ $transaksi->kode_transaksi }}</div>
                            <div class="text-sm text-slate-400">{{ $transaksi->tanggal_transaksi->format('d M Y') }}</div>
                        </div>
                        <div class="text-right">
                            <div class="font-medium text-slate-700">{{ $transaksi->total_formatted }}</div>
                            {!! $transaksi->status_badge !!}
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="p-8 text-center text-slate-400">
                    <p>Belum ada transaksi</p>
                </div>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection