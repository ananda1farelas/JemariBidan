@extends('layouts.admin')

@section('title', 'Kelola Transaksi - Jemari Bidan')
@section('page-title', 'Kelola Transaksi')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- Header & Filter --}}
    <div class="flex flex-col gap-4 mb-6">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold text-slate-800">Daftar Transaksi</h2>
            {{-- Toggle filter di mobile --}}
            <button type="button" onclick="toggleFilter()" 
                    class="md:hidden p-2 bg-slate-100 rounded-lg text-slate-600 hover:bg-slate-200 transition"
                    id="filter-toggle-btn">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
            </button>
        </div>

        <form method="GET" id="filter-form"
              class="hidden md:flex flex-col md:flex-row md:items-center gap-2 bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
            <input type="text" name="cari" value="{{ request('cari') }}" 
                   placeholder="Cari kode / nama..." 
                   class="px-4 py-2 rounded-xl border border-slate-200 text-sm focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none w-full md:w-48">

            <select name="status" class="px-4 py-2 rounded-xl border border-slate-200 text-sm focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none w-full md:w-auto">
                <option value="">Semua Status</option>
                <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>

            <div class="flex items-center gap-2 w-full md:w-auto">
                <input type="date" name="dari" value="{{ request('dari') }}" 
                       class="px-3 py-2 rounded-xl border border-slate-200 text-sm w-full">
                <span class="text-slate-400 hidden sm:inline">-</span>
                <input type="date" name="sampai" value="{{ request('sampai') }}" 
                       class="px-3 py-2 rounded-xl border border-slate-200 text-sm w-full">
            </div>

            <div class="flex gap-2 w-full md:w-auto">
                <button type="submit" class="flex-1 md:flex-none px-4 py-2 bg-sky-500 text-white rounded-xl text-sm font-medium hover:bg-sky-600 transition">
                    Filter
                </button>
                <a href="{{ route('admin.transaksi') }}" class="flex-1 md:flex-none px-4 py-2 border border-slate-200 text-slate-600 rounded-xl text-sm hover:bg-slate-50 transition text-center">
                    Reset
                </a>
            </div>
        </form>
    </div>

    @if(session('success'))
    <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm">
        {{ session('success') }}
    </div>
    @endif

    {{-- Summary Cards --}}
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
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-6">
        @foreach($counts as $status => $count)
        <a href="{{ route('admin.transaksi', ['status' => $status]) }}" class="p-3 sm:p-4 rounded-xl border {{ $colors[$status] }} hover:shadow-sm transition">
            <div class="text-xl sm:text-2xl font-bold">{{ $count }}</div>
            <div class="text-xs sm:text-sm opacity-80">{{ $labels[$status] }}</div>
        </a>
        @endforeach
    </div>

    {{-- Desktop: Tabel --}}
    <div class="hidden md:block bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
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
                        <div class="font-mono font-medium text-slate-800 text-sm">{{ $transaksi->kode_transaksi }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-slate-800 text-sm">{{ $transaksi->user->nama ?? '-' }}</div>
                        <div class="text-xs text-slate-400">{{ $transaksi->user->email ?? '' }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-500">{{ $transaksi->details->count() }} item</td>
                    <td class="px-6 py-4 font-medium text-slate-700 text-sm">{{ $transaksi->total_formatted }}</td>
                    <td class="px-6 py-4">{!! $transaksi->status_badge !!}</td>
                    <td class="px-6 py-4 text-sm text-slate-500">{{ $transaksi->tanggal_transaksi->format('d M Y H:i') }}</td>
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

    {{-- Mobile: Card Layout --}}
    <div class="md:hidden space-y-3">
        @forelse($transaksis as $transaksi)
        <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-sm">
            {{-- Header Card --}}
            <div class="flex items-start justify-between mb-3">
                <div>
                    <div class="font-mono font-semibold text-slate-800 text-sm">{{ $transaksi->kode_transaksi }}</div>
                    <div class="text-xs text-slate-400 mt-0.5">{{ $transaksi->tanggal_transaksi->format('d M Y H:i') }}</div>
                </div>
                <div class="shrink-0">{!! $transaksi->status_badge !!}</div>
            </div>

            {{-- Info Pelanggan --}}
            <div class="mb-3 pb-3 border-b border-slate-100">
                <div class="text-sm font-medium text-slate-800">{{ $transaksi->user->name ?? '-' }}</div>
                <div class="text-xs text-slate-400">{{ $transaksi->user->email ?? '' }}</div>
            </div>

            {{-- Detail Transaksi --}}
            <div class="flex items-center justify-between mb-4">
                <div class="text-sm text-slate-500">{{ $transaksi->details->count() }} item</div>
                <div class="font-bold text-slate-800">{{ $transaksi->total_formatted }}</div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.transaksi.show', $transaksi->id) }}" 
                   class="flex-1 flex items-center justify-center gap-1.5 px-3 py-2 bg-slate-50 text-slate-600 rounded-lg text-sm font-medium hover:bg-slate-100 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Detail
                </a>
                <a href="{{ route('admin.transaksi.edit', $transaksi->id) }}" 
                   class="flex-1 flex items-center justify-center gap-1.5 px-3 py-2 bg-sky-50 text-sky-600 rounded-lg text-sm font-medium hover:bg-sky-100 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <form action="{{ route('admin.transaksi.destroy', $transaksi->id) }}" method="POST" onsubmit="return confirm('Yakin hapus transaksi ini?')" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full flex items-center justify-center gap-1.5 px-3 py-2 bg-red-50 text-red-600 rounded-lg text-sm font-medium hover:bg-red-100 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-xl border border-slate-200 p-8 text-center text-slate-400">
            <svg class="w-12 h-12 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            <p class="text-sm">Belum ada transaksi</p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $transaksis->links() }}
    </div>

</div>

@push('scripts')
<script>
function toggleFilter() {
    const form = document.getElementById('filter-form');
    const btn = document.getElementById('filter-toggle-btn');

    if (form.classList.contains('hidden')) {
        form.classList.remove('hidden');
        form.classList.add('flex');
        btn.classList.add('bg-sky-100', 'text-sky-600');
    } else {
        form.classList.add('hidden');
        form.classList.remove('flex');
        btn.classList.remove('bg-sky-100', 'text-sky-600');
    }
}
</script>
@endpush

@endsection