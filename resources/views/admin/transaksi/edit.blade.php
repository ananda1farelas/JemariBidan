@extends('layouts.admin')

@section('title', 'Update Transaksi - Jemari Bidan')
@section('page-title', 'Update Transaksi')

@section('content')
<div class="max-w-2xl mx-auto">

    <div class="mb-6">
        <a href="{{ route('admin.transaksi') }}" class="text-slate-500 hover:text-slate-700 text-sm flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-100">
            <h2 class="text-xl font-bold text-slate-800">Update Status</h2>
            <p class="text-sm text-slate-400 mt-1">{{ $transaksi->kode_transaksi }}</p>
        </div>

        <div class="p-6">
            {{-- Info Ringkas --}}
            <div class="mb-6 p-4 bg-slate-50 rounded-xl">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm text-slate-500">Pelanggan</span>
                    <span class="font-medium text-slate-800">{{ $transaksi->user->name ?? '-' }}</span>
                </div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm text-slate-500">Total</span>
                    <span class="font-medium text-slate-800">{{ $transaksi->total_formatted }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-slate-500">Status Saat Ini</span>
                    {!! $transaksi->status_badge !!}
                </div>
            </div>

            <form action="{{ route('admin.transaksi.update', $transaksi->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Status --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Status Baru</label>
                    <select name="status" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition" required>
                        <option value="menunggu" {{ old('status', $transaksi->status) == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="diproses" {{ old('status', $transaksi->status) == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ old('status', $transaksi->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ old('status', $transaksi->status) == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>

                {{-- Catatan --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Catatan (Opsional)</label>
                    <textarea name="catatan" rows="4" 
                              class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition resize-y"
                              placeholder="Tambahkan catatan untuk transaksi ini...">{{ old('catatan', $transaksi->catatan) }}</textarea>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('admin.transaksi') }}" class="px-6 py-2.5 border border-slate-200 text-slate-600 rounded-xl font-medium hover:bg-white transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-sky-500 text-white rounded-xl font-medium hover:bg-sky-600 transition shadow-sm shadow-sky-200">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection