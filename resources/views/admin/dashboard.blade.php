@extends('layouts.admin')

@section('title', 'Dashboard Admin - Jemari Bidan')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">

    {{-- ═══════════════════════════════════════════════════════
        HEADER SECTION
    ═══════════════════════════════════════════════════════ --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Selamat Datang, {{ auth()->user()->nama ?? 'Admin' }}!</h1>
            <p class="text-sm text-slate-500 mt-1">{{ now()->format('l, d F Y') }}</p>
        </div>
        <a href="{{ route('admin.transaksi') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-sky-500 text-white rounded-xl font-medium hover:bg-sky-600 transition shadow-sm shadow-sky-200 text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            Kelola Transaksi
        </a>
    </div>

    {{-- ═══════════════════════════════════════════════════════
        STATS CARDS
    ═══════════════════════════════════════════════════════ --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

        {{-- Total User --}}
        <div class="bg-white rounded-xl p-4 sm:p-5 shadow-sm border border-slate-200 hover:shadow-md transition group">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center group-hover:bg-blue-100 transition">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">+{{ $newUsersThisWeek }} minggu ini</span>
            </div>
            <h3 class="text-2xl sm:text-3xl font-bold text-slate-800">{{ $stats['totalUser'] }}</h3>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Total Pengguna</p>
        </div>

        {{-- Total Transaksi --}}
        <div class="bg-white rounded-xl p-4 sm:p-5 shadow-sm border border-slate-200 hover:shadow-md transition group">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center group-hover:bg-emerald-100 transition">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">+{{ $newTransaksiThisWeek }} minggu ini</span>
            </div>
            <h3 class="text-2xl sm:text-3xl font-bold text-slate-800">{{ $stats['totalTransaksi'] }}</h3>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Total Transaksi</p>
        </div>

        {{-- Total Pendapatan --}}
        <div class="bg-white rounded-xl p-4 sm:p-5 shadow-sm border border-slate-200 hover:shadow-md transition group">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center group-hover:bg-amber-100 transition">
                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-xs font-medium {{ $pendapatanGrowth >= 0 ? 'text-emerald-600 bg-emerald-50' : 'text-red-600 bg-red-50' }} px-2 py-1 rounded-full">
                    {{ $pendapatanGrowth >= 0 ? '+' : '' }}{{ $pendapatanGrowth }}%
                </span>
            </div>
            <h3 class="text-2xl sm:text-3xl font-bold text-slate-800">Rp {{ number_format($stats['totalPendapatan'], 0, ',', '.') }}</h3>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Total Pendapatan</p>
        </div>

        {{-- Total Produk --}}
        <div class="bg-white rounded-xl p-4 sm:p-5 shadow-sm border border-slate-200 hover:shadow-md transition group">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center group-hover:bg-purple-100 transition">
                    <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-slate-400 bg-slate-50 px-2 py-1 rounded-full">{{ $kategoriCount }} kategori</span>
            </div>
            <h3 class="text-2xl sm:text-3xl font-bold text-slate-800">{{ $stats['totalProduk'] }}</h3>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Total Produk</p>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════
        QUICK STATS BAR
    ═══════════════════════════════════════════════════════ --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
        @php
            $quickStats = [
                ['label' => 'Menunggu', 'count' => $stats['menunggu'], 'color' => 'amber', 'route' => route('admin.transaksi', ['status' => 'menunggu'])],
                ['label' => 'Diproses', 'count' => $stats['diproses'], 'color' => 'blue', 'route' => route('admin.transaksi', ['status' => 'diproses'])],
                ['label' => 'Selesai', 'count' => $stats['selesai'], 'color' => 'emerald', 'route' => route('admin.transaksi', ['status' => 'selesai'])],
                ['label' => 'Dibatalkan', 'count' => $stats['dibatalkan'], 'color' => 'red', 'route' => route('admin.transaksi', ['status' => 'dibatalkan'])],
            ];
        @endphp
        @foreach($quickStats as $qs)
        <a href="{{ $qs['route'] }}" class="bg-white rounded-xl p-3 sm:p-4 border border-slate-200 hover:shadow-sm transition flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-{{ $qs['color'] }}-50 flex items-center justify-center shrink-0">
                <span class="text-{{ $qs['color'] }}-600 font-bold text-sm">{{ $qs['count'] }}</span>
            </div>
            <span class="text-sm font-medium text-slate-600">{{ $qs['label'] }}</span>
        </a>
        @endforeach
    </div>

    {{-- ═══════════════════════════════════════════════════════
        MAIN CONTENT GRID
    ═══════════════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- LEFT COLUMN: Chart + Transaksi Pending --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Chart Pendapatan --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 sm:p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Grafik Pendapatan</h3>
                        <p class="text-sm text-slate-500">7 hari terakhir</p>
                    </div>
                </div>
                <div class="h-64 flex items-end justify-between gap-2 sm:gap-3">
                    @forelse($chartData as $day)
                    <div class="flex-1 flex flex-col items-center gap-2">
                        <div class="w-full bg-sky-100 rounded-t-lg relative group cursor-pointer transition-all hover:bg-sky-200" style="height: {{ $day['percent'] }}%;">
                            <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap z-10">
                                Rp {{ number_format($day['value'], 0, ',', '.') }}
                            </div>
                        </div>
                        <span class="text-xs text-slate-500">{{ $day['label'] }}</span>
                    </div>
                    @empty
                    <div class="w-full h-full flex items-center justify-center text-slate-400">
                        <p class="text-sm">Belum ada data pendapatan</p>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- Transaksi Pending --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="flex items-center justify-between p-5 sm:p-6 border-b border-slate-100">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Transaksi Menunggu</h3>
                        <p class="text-sm text-slate-500">Perlu ditindaklanjuti</p>
                    </div>
                    <a href="{{ route('admin.transaksi', ['status' => 'menunggu']) }}" class="text-sm text-sky-600 hover:text-sky-700 font-medium">Lihat Semua</a>
                </div>

                <div class="divide-y divide-slate-100">
                    @forelse($pendingTransaksi as $transaksi)
                    <div class="flex items-center justify-between p-4 sm:p-5 hover:bg-slate-50 transition">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center shrink-0">
                                <span class="text-amber-600 font-bold text-xs">{{ strtoupper(substr($transaksi->user->nama ?? 'U', 0, 1)) }}</span>
                            </div>
                            <div>
                                <p class="font-medium text-slate-800 text-sm">{{ $transaksi->user->nama ?? 'User' }}</p>
                                <p class="text-xs text-slate-400">{{ $transaksi->kode_transaksi }} • {{ $transaksi->details->count() }} item</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-slate-800 text-sm">{{ $transaksi->total_formatted }}</p>
                            <p class="text-xs text-slate-400">{{ $transaksi->tanggal_transaksi->diffForHumans() }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="p-8 text-center text-slate-400">
                        <svg class="w-12 h-12 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm">Tidak ada transaksi menunggu</p>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>

        {{-- RIGHT COLUMN: Ringkasan + Aktivitas + Top Produk --}}
        <div class="space-y-6">

            {{-- Ringkasan Bulan Ini --}}
            <div class="bg-gradient-to-br from-sky-500 to-blue-600 rounded-xl p-5 sm:p-6 text-white">
                <h3 class="font-bold text-lg mb-4">Ringkasan Bulan Ini</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-blue-100 text-sm">Transaksi</span>
                        <span class="font-bold">{{ $bulanIniTransaksi }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-blue-100 text-sm">Pendapatan</span>
                        <span class="font-bold">Rp {{ number_format($bulanIniPendapatan, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-blue-100 text-sm">User Baru</span>
                        <span class="font-bold">{{ $bulanIniUser }}</span>
                    </div>
                </div>
                <div class="mt-5 pt-4 border-t border-white/20">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></div>
                        <span class="text-sm text-blue-100">Sistem berjalan normal</span>
                    </div>
                </div>
            </div>

            {{-- Aktivitas Terbaru --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-5 sm:p-6 border-b border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800">Aktivitas Terbaru</h3>
                </div>
                <div class="p-5 sm:p-6 space-y-4">
                    @forelse($recentActivities as $activity)
                    <div class="flex gap-3">
                        <div class="w-8 h-8 rounded-full bg-{{ $activity['color'] }}-100 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-{{ $activity['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $activity['icon'] !!}
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-800">{{ $activity['message'] }}</p>
                            <p class="text-xs text-slate-400 mt-0.5">{{ $activity['time'] }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-slate-400 py-4">
                        <p class="text-sm">Belum ada aktivitas</p>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- Top Produk --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-5 sm:p-6 border-b border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800">Produk Terlaris</h3>
                </div>
                <div class="divide-y divide-slate-100">
                    @forelse($topProduk as $i => $produk)
                    <div class="flex items-center gap-3 p-4 sm:p-5 hover:bg-slate-50 transition">
                        <div class="w-8 h-8 rounded-lg {{ $i < 3 ? 'bg-amber-100' : 'bg-slate-100' }} flex items-center justify-center shrink-0">
                            <span class="text-sm font-bold {{ $i < 3 ? 'text-amber-600' : 'text-slate-500' }}">#{{ $i + 1 }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-slate-800 text-sm truncate">{{ $produk['nama'] }}</p>
                            <p class="text-xs text-slate-400">{{ $produk['terjual'] }} terjual</p>
                        </div>
                        <span class="text-sm font-semibold text-emerald-600">Rp {{ number_format($produk['pendapatan'], 0, ',', '.') }}</span>
                    </div>
                    @empty
                    <div class="p-8 text-center text-slate-400">
                        <p class="text-sm">Belum ada data penjualan</p>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

</div>
@endsection