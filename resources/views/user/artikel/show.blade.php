@extends('layouts.user')

@section('title', $artikel->judul . ' - Jemari Bidan')
@section('page-title', 'Detail Artikel')

@section('content')
<div class="space-y-6">

    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm text-gray-500">
        <a href="{{ route('user.artikel') }}" class="hover:text-emerald-600">Artikel</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-emerald-600 font-medium">{{ $artikel->judul }}</span>
    </div>

    {{-- Artikel Content --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        {{-- Header Image --}}
        <div class="h-64 bg-gradient-to-br from-emerald-50 to-teal-50 flex items-center justify-center">
            <div class="w-24 h-24 rounded-3xl bg-white flex items-center justify-center shadow-lg">
                <svg class="w-12 h-12 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
            </div>
        </div>

        <div class="p-8">
            {{-- Meta --}}
            <div class="flex flex-wrap items-center gap-3 mb-4">
                <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full uppercase">{{ $artikel->kategori }}</span>
                <span class="text-sm text-gray-500">{{ $artikel->created_at->format('d M Y') }}</span>
                <span class="text-sm text-gray-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    {{ number_format($artikel->dibaca) }} kali baca
                </span>
            </div>

            {{-- Judul --}}
            <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ $artikel->judul }}</h1>

            {{-- Konten --}}
            <div class="prose prose-emerald max-w-none text-gray-600 leading-relaxed">
                {!! nl2br(e($artikel->konten)) !!}
            </div>
        </div>
    </div>

    {{-- Related Artikel --}}
    @if($related->count() > 0)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Artikel Terkait</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($related as $item)
            <a href="{{ route('user.artikel.show', $item->slug) }}" class="group p-4 rounded-xl border border-gray-100 hover:border-emerald-200 hover:bg-emerald-50 transition">
                <span class="text-xs text-emerald-600 font-medium uppercase">{{ $item->kategori }}</span>
                <h4 class="font-semibold text-gray-800 group-hover:text-emerald-600 transition mt-1 line-clamp-2">{{ $item->judul }}</h4>
            </a>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection