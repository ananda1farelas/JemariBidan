@extends('layouts.admin')

@section('title', 'Kelola Pengguna - Jemari Bidan')
@section('page-title', 'Kelola Pengguna')

@section('content')
<div class="max-w-7xl mx-auto">

    {{-- Header & Filter --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <h2 class="text-xl font-bold text-slate-800">Daftar Pengguna</h2>
        
        <div class="flex items-center gap-3">
            <form method="GET" class="flex items-center gap-2">
                <input type="text" name="cari" value="{{ request('cari') }}" 
                       placeholder="Cari nama / email / no hp..." 
                       class="px-4 py-2 rounded-xl border border-slate-200 text-sm focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none w-56">
                
                <select name="role" class="px-4 py-2 rounded-xl border border-slate-200 text-sm focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none">
                    <option value="">Semua Role</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>

                <button type="submit" class="px-4 py-2 bg-sky-500 text-white rounded-xl text-sm font-medium hover:bg-sky-600 transition">
                    Cari
                </button>
                <a href="{{ route('admin.pengguna') }}" class="px-4 py-2 border border-slate-200 text-slate-600 rounded-xl text-sm hover:bg-white transition">
                    Reset
                </a>
            </form>
            
            <a href="{{ route('admin.pengguna.create') }}" class="px-5 py-2.5 bg-sky-500 text-white rounded-xl font-medium hover:bg-sky-600 transition shadow-sm shadow-sky-200 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl">
        {{ session('error') }}
    </div>
    @endif

    {{-- Stats --}}
    <div class="grid grid-cols-2 gap-4 mb-6">
        <div class="p-4 rounded-xl border bg-sky-50 border-sky-200">
            <div class="text-2xl font-bold text-sky-700">{{ $totalUser }}</div>
            <div class="text-sm text-sky-600">User</div>
        </div>
        <div class="p-4 rounded-xl border bg-purple-50 border-purple-200">
            <div class="text-2xl font-bold text-purple-700">{{ $totalAdmin }}</div>
            <div class="text-sm text-purple-600">Admin</div>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr>
                    <th class="px-6 py-4 text-sm font-semibold text-slate-600">Pengguna</th>
                    <th class="px-6 py-4 text-sm font-semibold text-slate-600">Kontak</th>
                    <th class="px-6 py-4 text-sm font-semibold text-slate-600">Role</th>
                    <th class="px-6 py-4 text-sm font-semibold text-slate-600">Bergabung</th>
                    <th class="px-6 py-4 text-sm font-semibold text-slate-600 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($users as $user)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-sky-100 flex items-center justify-center text-sky-600 font-bold text-sm">
                                {{ $user->avatar }}
                            </div>
                            <div>
                                <div class="font-medium text-slate-800">{{ $user->nama }}</div>
                                <div class="text-xs text-slate-400">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-500">
                        {{ $user->no_hp ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        {!! $user->role_badge !!}
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-500">
                        {{ $user->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.pengguna.show', $user->id) }}" class="p-2 text-slate-500 hover:bg-slate-100 rounded-lg transition" title="Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            <a href="{{ route('admin.pengguna.edit', $user->id) }}" class="p-2 text-sky-500 hover:bg-sky-50 rounded-lg transition" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            @if($user->id !== auth()->id())
                            <form action="{{ route('admin.pengguna.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus pengguna ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                        <svg class="w-12 h-12 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <p>Belum ada pengguna</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>

</div>
@endsection