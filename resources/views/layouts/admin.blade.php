<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">
    <title>@yield('title', 'Admin - Jemari Bidan')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        
        .admin-sidebar {
            width: 260px;
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #1e293b; /* slate-800 */
            z-index: 50;
        }
        
        .admin-main {
            margin-left: 260px;
            min-height: 100vh;
            background: #f1f5f9; /* slate-100 */
        }
        
        .nav-item {
            transition: all 0.2s;
        }
        .nav-item:hover {
            background: rgba(255,255,255,0.05);
        }
        .nav-item.active {
            background: #0ea5e9; /* sky-500 */
            color: white;
        }
        
        @media (max-width: 1023px) {
            .admin-sidebar { transform: translateX(-100%); }
            .admin-sidebar.open { transform: translateX(0); }
            .admin-main { margin-left: 0; }
        }
    </style>
    
    @yield('styles')
</head>
<body>

    {{-- Sidebar --}}
    <aside id="admin-sidebar" class="admin-sidebar flex flex-col">
        {{-- Logo --}}
        <div class="p-5 border-b border-slate-700">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full border-2 border-sky-500 bg-white flex items-center justify-center overflow-hidden">
                    <img src="{{ url('images/logo/logo-jemari.png') }}" alt="Jemari Bidan" class="w-7 h-7 object-contain">
                </div>
                <div>
                    <h1 class="text-lg font-bold text-white">Jemari Bidan</h1>
                    <p class="text-xs text-slate-400">Admin Panel</p>
                </div>
            </div>
        </div>

        {{-- Admin Info --}}
        <div class="p-4 border-b border-slate-700">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-sky-500 flex items-center justify-center text-white font-bold text-sm">
                    {{ strtoupper(substr(auth()->user()->nama ?? 'A', 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-white truncate">{{ auth()->user()->nama ?? 'Admin' }}</p>
                    <p class="text-xs text-slate-400">Administrator</p>
                </div>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
            
            <a href="{{ route('admin.dashboard') }}" 
               class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : 'text-slate-300' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('admin.artikel') }}" 
               class="nav-item {{ request()->routeIs('admin.artikel*') ? 'active' : 'text-slate-300' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
                Kelola Artikel
            </a>

            <a href="{{ route('admin.produk') }}" 
               class="nav-item {{ request()->routeIs('admin.produk*') ? 'active' : 'text-slate-300' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                Kelola Produk
            </a>

            <a href="{{ route('admin.transaksi') }}" 
               class="nav-item {{ request()->routeIs('admin.transaksi*') ? 'active' : 'text-slate-300' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Kelola Transaksi
            </a>

            <a href="{{ route('admin.pengguna') }}" 
               class="nav-item {{ request()->routeIs('admin.pengguna*') ? 'active' : 'text-slate-300' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                Kelola Pengguna
            </a>

            <div class="pt-4 mt-4 border-t border-slate-700">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-red-400 hover:bg-red-500/10 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    {{-- Main Content --}}
    <div class="admin-main">
        {{-- Topbar --}}
        <header class="bg-white border-b border-slate-200 px-6 py-4 sticky top-0 z-40">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg hover:bg-slate-100">
                        <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <h2 class="text-xl font-bold text-slate-800">@yield('page-title', 'Dashboard')</h2>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm text-slate-500">{{ now()->format('d M Y') }}</span>
                    <div class="w-8 h-8 rounded-full bg-sky-100 flex items-center justify-center">
                        <span class="text-sky-600 font-bold text-sm">{{ strtoupper(substr(auth()->user()->nama ?? 'A', 0, 1)) }}</span>
                    </div>
                </div>
            </div>
        </header>

        {{-- Content --}}
        <main class="p-6">
            @yield('content')
        </main>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('admin-sidebar').classList.toggle('open');
        }
    </script>
    
    @yield('scripts')
</body>
</html>