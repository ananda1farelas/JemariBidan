@extends('layouts.admin')

@section('title', 'Kelola Artikel - Jemari Bidan')
@section('page-title', 'Kelola Artikel')

@section('content')
<div class="space-y-6">

    {{-- Header + Tombol Tambah --}}
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Kelola Artikel</h2>
            <p class="text-slate-500 mt-1">Kelola artikel kesehatan ibu dan anak</p>
        </div>
        <a href="{{ route('admin.artikel.create') }}" 
           class="inline-flex items-center gap-2 bg-sky-500 text-white px-5 py-2.5 rounded-xl font-medium hover:bg-sky-600 transition shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Artikel
        </a>
    </div>

    {{-- Alert --}}
    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left text-xs font-semibold text-slate-500 uppercase px-6 py-4">Judul</th>
                        <th class="text-left text-xs font-semibold text-slate-500 uppercase px-6 py-4">Kategori</th>
                        <th class="text-left text-xs font-semibold text-slate-500 uppercase px-6 py-4">Status</th>
                        <th class="text-left text-xs font-semibold text-slate-500 uppercase px-6 py-4">Dibaca</th>
                        <th class="text-left text-xs font-semibold text-slate-500 uppercase px-6 py-4">Tanggal</th>
                        <th class="text-left text-xs font-semibold text-slate-500 uppercase px-6 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($artikels as $artikel)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4">
                            <div class="font-medium text-slate-800">{{ $artikel->judul }}</div>
                            <div class="text-xs text-slate-500">{{ Str::limit($artikel->excerpt, 50) }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                {{ $artikel->kategori === 'ibu' ? 'bg-pink-100 text-pink-700' : 
                                   ($artikel->kategori === 'bayi' ? 'bg-emerald-100 text-emerald-700' : 
                                   ($artikel->kategori === 'gizi' ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-700')) }}">
                                {{ ucfirst($artikel->kategori) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($artikel->publish)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                                Publish
                            </span>
                            @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                Draft
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ number_format($artikel->dibaca) }}</td>
                        <td class="px-6 py-4 text-sm text-slate-500">{{ $artikel->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.artikel.edit', $artikel->id) }}" 
                                   class="p-2 text-sky-600 hover:bg-sky-50 rounded-lg transition" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.artikel.destroy', $artikel->id) }}" method="POST" 
                                      onsubmit="return confirm('Yakin hapus artikel ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-slate-100 flex items-center justify-center">
                                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-slate-700 mb-1">Belum Ada Artikel</h3>
                            <p class="text-slate-500 mb-4">Mulai tambah artikel pertama</p>
                            <a href="{{ route('admin.artikel.create') }}" class="inline-flex items-center gap-2 bg-sky-500 text-white px-5 py-2.5 rounded-xl font-medium hover:bg-sky-600 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Tambah Artikel
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($artikels->count() > 0)
        <div class="px-6 py-4 border-t border-slate-100">
            {{ $artikels->links() }}
        </div>
        @endif
    </div>

</div>
@endsection