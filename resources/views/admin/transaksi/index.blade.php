@extends('layouts.admin')

@section('title', 'Kelola Transaksi - Jemari Bidan')
@section('page-title', 'Kelola Transaksi')

@section('content')
<div class="max-w-7xl mx-auto">

    {{-- Header & Filter --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <h2 class="text-xl font-bold text-slate-800">Daftar Transaksi</h2>
        
        <form method="GET" class="flex flex-wrap items-center gap-2">
            <input type="text" name="cari" value="{{ request('cari') }}" 
                   placeholder="Cari kode / nama..." 
                   class="px-4 py-2 rounded-xl border border-slate-200 text-sm focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none w-48">
            
            <select name="status" class="px-4 py-2 rounded-xl border border-slate-200 text-sm focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none">
                <option value="">Semua Status</option>
                <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>

            <input type="date" name="dari" value="{{ request('dari') }}" 
                   class="px-3 py-2 rounded-xl border border-slate-200 text-sm">
            <span class="text-slate-400">-</span>
            <input type="date" name="sampai" value="{{ request('sampai') }}" 
                   class="px-3 py-2 rounded-xl border border-slate-200 text-sm">

            <button type="submit" class="px-4 py-2 bg-sky-500 text-white rounded-xl text-sm font-medium hover:bg-sky-600 transition">
                Filter
            </button>
            <a href="{{ route('admin.transaksi') }}" class="px-4 py-2 border border-slate-200 text-slate-600 rounded-xl text-sm hover:bg-white transition">
                Reset
            </a>
        </form>
    </div>

    @if(session('success'))
    <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl">
        {{ session('success') }}
    </div>
    @endif

    {{-- Summary Cards --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        @php
            $counts = [
                'menunggu' => \App\Models\Transaksi::where('status', 'menunggu')->count(),
                'diproses' => \App\Models\Transaksi::where('status', 'diproses')->count(),
                'selesai' => \App\Models\Transaksi::where('status', 'selesai')->count(),
                'dibatalkan' => \App\Models\Transaksi::where('status', 'dibatalkan')->count(),
            ];
            $colors = [
                'menunggu' => 'bg-amber-50 border-amber-200 text-amber-700',
                'diproses' => 'bg-blue-50 border-blue-200 text-blue-700',
                'selesai' => 'bg-emerald-50 border-emerald-200 text-emerald-700',
                'dibatalkan' => 'bg-red-50 border-red-200 text-red-700',
            ];
            $labels = [
                'menunggu' => 'Menunggu',
                'diproses' => 'Diproses',
                'selesai' => 'Selesai',
                'dibatalkan' => 'Dibatalkan',
            ];
        @endphp
        @foreach($counts as $status => $count)
        <a href="{{ route('admin.transaksi', ['status' => $status]) }}" class="p-4 rounded-xl border {{ $colors[$status] }} hover:shadow-sm transition">
            <div class="text-2xl font-bold">{{ $count }}</div>
            <div class="text-sm opacity-80">{{ $labels[$status] }}</div>
        </a>
        @endforeach
    </div>

    {{-- Tabel --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr>
                    <th class="px-6 py-4 text-sm font-semibold text-slate-600">Kode</th>
                    <th class="px-6 py-4 text-sm font-semibold text-slate-600">Pelanggan</th>
                    <th class="px-6 py-4 text-sm font-semibold text-slate-600">Item</th>
                    <th class="px-6 py-4 text-sm font-semibold text-slate-600">Total</th>
                    <th class="px-6 py-4 text-sm font-semibold text-slate-600">Status</th>
                    <th class="px-6 py-4 text-sm font-semibold text-slate-600">Tanggal</th>
                    <th class="px-6 py-4 text-sm font-semibold text-slate-600 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($transaksis as $transaksi)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4">
                        <div class="font-mono font-medium text-slate-800">{{ $transaksi->kode_transaksi }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-slate-800">{{ $transaksi->user->name ?? '-' }}</div>
                        <div class="text-xs text-slate-400">{{ $transaksi->user->email ?? '' }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-500">
                        {{ $transaksi->details->count() }} item
                    </td>
                    <td class="px-6 py-4 font-medium text-slate-700">
                        {{ $transaksi->total_formatted }}
                    </td>
                    <td class="px-6 py-4">
                        {!! $transaksi->status_badge !!}
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-500">
                        {{ $transaksi->tanggal_transaksi->format('d M Y H:i') }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.transaksi.show', $transaksi->id) }}" class="p-2 text-slate-500 hover:bg-slate-100 rounded-lg transition" title="Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            <a href="{{ route('admin.transaksi.edit', $transaksi->id) }}" class="p-2 text-sky-500 hover:bg-sky-50 rounded-lg transition" title="Edit Status">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form action="{{ route('admin.transaksi.destroy', $transaksi->id) }}" method="POST" onsubmit="return confirm('Yakin hapus transaksi ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-slate-400">
                        <svg class="w-12 h-12 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <p>Belum ada transaksi</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $transaksis->links() }}
    </div>

</div>
@endsection