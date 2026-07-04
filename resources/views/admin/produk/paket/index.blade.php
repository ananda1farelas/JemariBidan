@extends('layouts.admin')

@section('title', 'Paket Produk - Jemari Bidan')
@section('page-title', 'Paket Produk')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.produk') }}" class="text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h2 class="text-xl font-bold text-slate-800">Daftar Paket</h2>
        </div>
        <a href="{{ route('admin.produk.paket.create') }}" class="px-4 sm:px-5 py-2.5 bg-sky-500 text-white rounded-xl font-medium hover:bg-sky-600 transition shadow-sm shadow-sky-200 flex items-center gap-2 text-sm sm:text-base">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span class="hidden sm:inline">Tambah Paket</span>
            <span class="sm:hidden">Tambah</span>
        </a>
    </div>

    @if(session('success'))
    <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm">
        {{ session('success') }}
    </div>
    @endif

    {{-- Desktop: Tabel --}}
    <div class="hidden md:block bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr>
                    <th class="px-6 py-4 text-sm font-semibold text-slate-600">Paket</th>
                    <th class="px-6 py-4 text-sm font-semibold text-slate-600">Kategori</th>
                    <th class="px-6 py-4 text-sm font-semibold text-slate-600">Harga</th>
                    <th class="px-6 py-4 text-sm font-semibold text-slate-600">Durasi</th>
                    <th class="px-6 py-4 text-sm font-semibold text-slate-600">Status</th>
                    <th class="px-6 py-4 text-sm font-semibold text-slate-600 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($pakets as $paket)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            @if($paket->gambar)
                                <img src="{{ $paket->gambar }}" class="w-12 h-12 rounded-lg object-cover" alt="">
                            @else
                                <div class="w-12 h-12 rounded-lg bg-slate-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                </div>
                            @endif
                            <div>
                                <div class="font-medium text-slate-800">{{ $paket->nama }}</div>
                                <div class="text-xs text-slate-400">{{ Str::limit($paket->deskripsi, 40) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 rounded-lg text-xs font-medium 
                            {{ $paket->kategori->slug == 'mom' ? 'bg-pink-50 text-pink-600' : 'bg-sky-50 text-sky-600' }}">
                            {{ $paket->kategori->nama }}
                        </span>
                    </td>
                    <td class="px-6 py-4 font-medium text-slate-700">{{ $paket->harga_formatted }}</td>
                    <td class="px-6 py-4 text-sm text-slate-500">{{ $paket->durasi }} menit</td>
                    <td class="px-6 py-4">
                        @if($paket->aktif)
                            <span class="px-2.5 py-1 rounded-lg text-xs font-medium bg-emerald-50 text-emerald-600">Aktif</span>
                        @else
                            <span class="px-2.5 py-1 rounded-lg text-xs font-medium bg-slate-100 text-slate-500">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.produk.paket.edit', $paket->id) }}" class="p-2 text-sky-500 hover:bg-sky-50 rounded-lg transition" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form action="{{ route('admin.produk.paket.destroy', $paket->id) }}" method="POST" onsubmit="return confirm('Yakin hapus paket ini?')" class="inline">
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
                    <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                        <svg class="w-12 h-12 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        <p>Belum ada paket</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Mobile: Card Layout --}}
    <div class="md:hidden space-y-3">
        @forelse($pakets as $paket)
        <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-sm">
            {{-- Header Card --}}
            <div class="flex items-start gap-3 mb-3 pb-3 border-b border-slate-100">
                @if($paket->gambar)
                    <img src="{{ $paket->gambar }}" class="w-14 h-14 rounded-lg object-cover shrink-0" alt="">
                @else
                    <div class="w-14 h-14 rounded-lg bg-slate-100 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                @endif
                <div class="min-w-0 flex-1">
                    <div class="flex items-start justify-between gap-2">
                        <div class="font-semibold text-slate-800 text-sm">{{ $paket->nama }}</div>
                        <div class="shrink-0">
                            @if($paket->aktif)
                                <span class="px-2 py-0.5 rounded-lg text-xs font-medium bg-emerald-50 text-emerald-600">Aktif</span>
                            @else
                                <span class="px-2 py-0.5 rounded-lg text-xs font-medium bg-slate-100 text-slate-500">Nonaktif</span>
                            @endif
                        </div>
                    </div>
                    <div class="text-xs text-slate-400 mt-0.5">{{ Str::limit($paket->deskripsi, 45) }}</div>
                </div>
            </div>

            {{-- Detail --}}
            <div class="flex items-center justify-between mb-4">
                <span class="px-2.5 py-1 rounded-lg text-xs font-medium 
                    {{ $paket->kategori->slug == 'mom' ? 'bg-pink-50 text-pink-600' : 'bg-sky-50 text-sky-600' }}">
                    {{ $paket->kategori->nama }}
                </span>
                <div class="text-right">
                    <div class="font-bold text-slate-800 text-sm">{{ $paket->harga_formatted }}</div>
                    <div class="text-xs text-slate-400">{{ $paket->durasi }} menit</div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.produk.paket.edit', $paket->id) }}" 
                   class="flex-1 flex items-center justify-center gap-1.5 px-3 py-2 bg-sky-50 text-sky-600 rounded-lg text-sm font-medium hover:bg-sky-100 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <form action="{{ route('admin.produk.paket.destroy', $paket->id) }}" method="POST" onsubmit="return confirm('Yakin hapus paket ini?')" class="flex-1">
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            <p class="text-sm">Belum ada paket</p>
        </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $pakets->links() }}
    </div>

</div>
@endsection