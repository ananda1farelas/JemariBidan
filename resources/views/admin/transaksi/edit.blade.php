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

    @php
        $isLocked = in_array($transaksi->status, ['selesai', 'dibatalkan']);
        $lockMessage = $transaksi->status == 'selesai' 
            ? 'Transaksi ini sudah selesai!.' 
<<<<<<< HEAD
            : 'Transaksi ini telah dibatalkan!.';
=======
            : 'Transaksi ini telah dibatalkan!';
>>>>>>> 58d0ae0203c2f9d37cb2a7b876c14192c84a9163
    @endphp

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

            {{-- Alert kalau status locked --}}
            @if($isLocked)
            <div class="mb-6 p-4 bg-amber-50 border border-amber-200 rounded-xl flex items-start gap-3">
                <svg class="w-5 h-5 text-amber-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <div>
                    <p class="text-sm font-medium text-amber-800">Status Terkunci</p>
                    <p class="text-sm text-amber-600 mt-0.5">{{ $lockMessage }}</p>
                </div>
            </div>
            @endif

            <form action="{{ route('admin.transaksi.update', $transaksi->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Status --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Status Baru</label>

                    @if($isLocked)
                        {{-- Status final: tampilkan readonly --}}
                        <div class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                @if($transaksi->status == 'selesai')
                                    <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <span class="font-medium text-slate-700">Selesai</span>
                                @else
                                    <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </div>
                                    <span class="font-medium text-slate-700">Dibatalkan</span>
                                @endif
                            </div>
                            <span class="text-xs text-slate-400 bg-slate-100 px-2 py-1 rounded-full">Terkunci</span>
                        </div>
                        <input type="hidden" name="status" value="{{ $transaksi->status }}">
                    @else
                        {{-- Status masih bisa diubah --}}
                        <select name="status" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition" required>
                            <option value="menunggu" {{ old('status', $transaksi->status) == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="diproses" {{ old('status', $transaksi->status) == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ old('status', $transaksi->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="dibatalkan" {{ old('status', $transaksi->status) == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                        <p class="text-xs text-slate-400 mt-1.5">
                            <span class="text-amber-500">*</span> Pilih "Selesai" atau "Dibatalkan" akan mengunci transaksi ini.
                        </p>
                    @endif
                </div>

                {{-- Catatan --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Catatan (Opsional)</label>
                    <textarea name="catatan" rows="4" 
                              class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition resize-y {{ $isLocked ? 'bg-slate-50' : '' }}"
                              placeholder="Tambahkan catatan untuk transaksi ini..."
                              {{ $isLocked ? 'readonly' : '' }}>{{ old('catatan', $transaksi->catatan) }}</textarea>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('admin.transaksi') }}" class="px-6 py-2.5 border border-slate-200 text-slate-600 rounded-xl font-medium hover:bg-white transition">
                        Kembali
                    </a>
                    @if(!$isLocked)
                        <button type="submit" class="px-6 py-2.5 bg-sky-500 text-white rounded-xl font-medium hover:bg-sky-600 transition shadow-sm shadow-sky-200">
                            Simpan Perubahan
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
