@extends('layouts.user')

@section('title', 'Checkout - Jemari Bidan')
@section('page-title', 'Checkout')

@section('content')
<div class="space-y-6 max-w-4xl mx-auto">

    {{-- Header --}}
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Checkout</h2>
        <p class="text-gray-500">Konfirmasi pesanan treatment Anda</p>
    </div>

    {{-- Ringkasan Pesanan --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                Ringkasan Pesanan
            </h3>
        </div>
        
        <div class="p-6">
            <div class="space-y-4">
                @foreach($items as $item)
                <div class="flex items-center justify-between p-4 rounded-xl bg-gray-50 border border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-lg bg-emerald-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">{{ $item['paket']->nama }}</h4>
                            <p class="text-xs text-gray-500">{{ $item['paket']->kategori->nama }} × {{ $item['qty'] }}</p>
                        </div>
                    </div>
                    <span class="font-bold text-gray-800">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                </div>
                @endforeach
            </div>

            {{-- Total --}}
            <div class="mt-6 pt-4 border-t border-gray-200 flex items-center justify-between">
                <span class="text-gray-600">Total Pembayaran</span>
                <span class="text-2xl font-bold text-emerald-600">{{ $totalFormatted }}</span>
            </div>
        </div>
    </div>

    {{-- Form Data Pemesan --}}
    <form action="{{ route('user.checkout.store') }}" method="POST" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @csrf
        
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Data Pemesan
            </h3>
        </div>

        <div class="p-6 space-y-5">
            {{-- Nama --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" 
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition"
                       placeholder="Masukkan nama lengkap" required>
                @error('nama')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- No HP --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor HP</label>
                <input type="tel" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" 
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition"
                       placeholder="081234567890" required>
                @error('no_hp')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Alamat --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                <textarea name="alamat" rows="3" 
                          class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition resize-none"
                          placeholder="Alamat lengkap untuk treatment homecare" required>{{ old('alamat', $user->alamat) }}</textarea>
                @error('alamat')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal Treatment --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Treatment</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', now()->format('Y-m-d')) }}" 
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition text-gray-700 appearance-none min-h-[48px]"
                    style="-webkit-appearance: none;"
                    required>
                @error('tanggal')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Catatan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                <textarea name="catatan" rows="2" 
                          class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition resize-none"
                          placeholder="Catatan khusus untuk treatment">{{ old('catatan') }}</textarea>
                @error('catatan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Submit --}}
        <div class="p-6 border-t border-gray-100 bg-gray-50">
            <div class="flex items-center justify-between mb-4">
                <span class="text-gray-600">Total</span>
                <span class="text-xl font-bold text-emerald-600">{{ $totalFormatted }}</span>
            </div>
            <button type="submit" 
                    class="w-full py-4 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-xl font-bold text-lg hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Konfirmasi Pesanan
            </button>
        </div>
    </form>

</div>
@endsection