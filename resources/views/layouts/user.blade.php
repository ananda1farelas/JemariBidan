<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Jemari Bidan - User Dashboard')</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #f9fafb;
            min-height: 100vh;
        }

        .app-layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 288px;
            min-height: 100vh;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 50;
            background: white;
            box-shadow: 4px 0 24px rgba(0,0,0,0.08);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
        }

        .main-content {
            flex: 1;
            margin-left: 288px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        @media (max-width: 1023px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.open {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
        }

        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 2px; }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #10b981; border-radius: 3px; }

        .menu-active {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        @keyframes bounce-cart {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }
        .cart-badge-animate { animation: bounce-cart 0.3s ease; }

        .modal-overlay { 
            background: rgba(0, 0, 0, 0.5); 
            backdrop-filter: blur(4px); 
        }

        /* Notif Dropdown */
        .notif-dropdown {
            transform-origin: top right;
            transition: all 0.2s ease-out;
        }
        .notif-dropdown.hidden {
            opacity: 0;
            transform: scale(0.95);
            pointer-events: none;
        }
        .notif-dropdown:not(.hidden) {
            opacity: 1;
            transform: scale(1);
            pointer-events: auto;
        }

        @keyframes notif-bell {
            0%, 100% { transform: rotate(0); }
            10% { transform: rotate(15deg); }
            20% { transform: rotate(-15deg); }
            30% { transform: rotate(10deg); }
            40% { transform: rotate(-10deg); }
            50% { transform: rotate(5deg); }
            60% { transform: rotate(-5deg); }
            70% { transform: rotate(2deg); }
            80% { transform: rotate(-2deg); }
        }
        .notif-bell-ring { animation: notif-bell 1s ease; }

        /* ═══════════════════════════════════════════════
           POPUP NOTIFIKASI (TOAST) STYLES
        ═══════════════════════════════════════════════ */
        @keyframes popup-slide-in {
            from {
                transform: translateX(120%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        @keyframes popup-slide-out {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(120%);
                opacity: 0;
            }
        }
        @keyframes popup-progress {
            from { width: 100%; }
            to { width: 0%; }
        }

        .popup-notif {
            animation: popup-slide-in 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        .popup-notif.hiding {
            animation: popup-slide-out 0.3s ease-in forwards;
        }
        .popup-progress-bar {
            animation: popup-progress 5s linear forwards;
        }

        /* Status colors for popup */
        .popup-menunggu { border-left: 4px solid #f59e0b; }
        .popup-diproses { border-left: 4px solid #3b82f6; }
        .popup-selesai { border-left: 4px solid #10b981; }
        .popup-dibatalkan { border-left: 4px solid #ef4444; }

        .popup-menunggu .popup-icon { color: #f59e0b; background: #fffbeb; }
        .popup-diproses .popup-icon { color: #3b82f6; background: #eff6ff; }
        .popup-selesai .popup-icon { color: #10b981; background: #ecfdf5; }
        .popup-dibatalkan .popup-icon { color: #ef4444; background: #fef2f2; }
    </style>

    @yield('styles')
</head>
<body>

    {{-- ═══════════════════════════════════════════════
        POPUP NOTIFIKASI CONTAINER (Fixed top-right)
    ═══════════════════════════════════════════════ --}}
    <div id="popup-container" class="fixed top-20 right-4 sm:right-6 z-[80] flex flex-col gap-3 w-[calc(100%-2rem)] sm:w-[400px] max-w-[400px] pointer-events-none">
        {{-- Popup notifikasi muncul di sini --}}
    </div>

    {{-- Mobile Overlay --}}
    <div id="mobile-overlay" class="fixed inset-0 modal-overlay z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

    {{-- ========================================== --}}
    {{-- SIDEBAR --}}
    {{-- ========================================== --}}
    <aside id="sidebar" class="sidebar">

        {{-- Logo --}}
        <div class="p-6 border-b border-gray-100 flex-shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-800">Jemari Bidan</h1>
                    <p class="text-xs text-emerald-600 font-medium">Care for Mom & Baby</p>
                </div>
            </div>
        </div>

        {{-- User Profile --}}
        <div class="px-6 py-4 border-b border-gray-100 flex-shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center">
                    <span class="text-emerald-700 font-semibold text-sm">
                        {{ strtoupper(substr(auth()->user()->nama ?? 'User', 0, 2)) }}
                    </span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-800 truncate">{{ auth()->user()->nama ?? 'Nama User' }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email ?? 'user@email.com' }}</p>
                </div>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">

            {{-- Dashboard --}}
            <a href="{{ route('user.dashboard') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 hover:bg-emerald-50 {{ request()->routeIs('user.dashboard') ? 'menu-active' : 'text-gray-600' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
                <span class="font-medium">Dashboard</span>
            </a>

            {{-- Katalog Produk --}}
            <a href="{{ route('user.katalog') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 hover:bg-emerald-50 {{ request()->routeIs('user.katalog*') ? 'menu-active' : 'text-gray-600' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <span class="font-medium">Katalog Produk</span>
            </a>

            {{-- History Transaksi --}}
            <a href="{{ route('user.history') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 hover:bg-emerald-50 {{ request()->routeIs('user.history') ? 'menu-active' : 'text-gray-600' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
                <span class="font-medium">History Transaksi</span>
            </a>

            {{-- Artikel Kesehatan --}}
            <a href="{{ route('user.artikel') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 hover:bg-emerald-50 {{ request()->routeIs('user.artikel') ? 'menu-active' : 'text-gray-600' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
                <span class="font-medium">Artikel Kesehatan</span>
            </a>

            {{-- Divider --}}
            <div class="my-4 border-t border-gray-100"></div>

            {{-- Logout --}}
            <form action="{{ route('logout') }}" method="POST" class="mt-2">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-500 hover:bg-red-50 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span class="font-medium">Keluar</span>
                </button>
            </form>
        </nav>

        {{-- Footer Sidebar --}}
        <div class="p-4 border-t border-gray-100 flex-shrink-0">
            <p class="text-xs text-gray-400 text-center">&copy; 2025 Jemari Bidan</p>
        </div>
    </aside>

    {{-- ========================================== --}}
    {{-- MAIN CONTENT AREA --}}
    {{-- ========================================== --}}
    <div class="main-content">

        {{-- Top Navbar (Sticky) --}}
        <header class="sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-gray-100 px-4 sm:px-6 py-4">
            <div class="flex items-center justify-between">

                {{-- Left: Hamburger + Breadcrumb --}}
                <div class="flex items-center gap-4">
                    <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <nav class="hidden sm:flex items-center gap-2 text-sm text-gray-500">
                        <span>User</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <span class="text-emerald-600 font-medium">@yield('page-title', 'Dashboard')</span>
                    </nav>
                </div>

                {{-- Right: Search + Cart + Notif --}}
                <div class="flex items-center gap-2 sm:gap-3">

                    {{-- Search --}}
                    <div class="hidden md:flex items-center bg-gray-100 rounded-full px-4 py-2 w-64">
                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" placeholder="Cari treatment..." class="bg-transparent border-none outline-none text-sm w-full placeholder-gray-400">
                    </div>

                    {{-- 🛒 CART ICON --}}
                    <button onclick="openCartModal()" class="relative p-2 sm:p-2.5 rounded-full bg-emerald-50 hover:bg-emerald-100 transition-all duration-200 group">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-emerald-600 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none">
                            <path d="M9 11V6C9 4.34315 10.3431 3 12 3C13.6569 3 15 4.34315 15 6V11" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4 11H20L18.5 20H5.5L4 11Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 14V17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M12 14V17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M16 14V17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            <circle cx="8.5" cy="20.5" r="1.5" fill="currentColor"/>
                            <circle cx="15.5" cy="20.5" r="1.5" fill="currentColor"/>
                        </svg>

                        <span id="cart-badge" class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] sm:text-xs font-bold w-4 h-4 sm:w-5 sm:h-5 rounded-full flex items-center justify-center shadow-md cart-badge-animate">
                            {{ count(session('keranjang', [])) }}
                        </span>
                    </button>

                    {{-- 🔔 NOTIFICATION DROPDOWN --}}
                    <div class="relative" id="notif-container">
                        <button onclick="toggleNotifDropdown()" class="relative p-2 sm:p-2.5 rounded-full bg-gray-50 hover:bg-gray-100 transition-all duration-200" id="notif-btn">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="notif-icon">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            {{-- Badge notif belum dibaca --}}
                            <span id="notif-badge" class="absolute top-1.5 right-1.5 w-2.5 h-2.5 bg-red-500 rounded-full hidden"></span>
                        </button>

                        {{-- Dropdown Notifikasi --}}
                        <div id="notif-dropdown" class="notif-dropdown hidden absolute right-0 mt-2 w-[340px] sm:w-[380px] bg-white rounded-2xl shadow-xl border border-gray-100 z-50 overflow-hidden">
                            {{-- Header --}}
                            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                                <div>
                                    <h3 class="font-bold text-gray-800">Notifikasi</h3>
                                    <p class="text-xs text-gray-400 mt-0.5" id="notif-subtitle">Memuat...</p>
                                </div>
                                <button onclick="markAllRead()" class="text-xs text-emerald-600 hover:text-emerald-700 font-medium px-2 py-1 rounded-lg hover:bg-emerald-50 transition">
                                    Tandai dibaca
                                </button>
                            </div>

                            {{-- List Notifikasi --}}
                            <div id="notif-list" class="max-h-[360px] overflow-y-auto">
                                <div class="flex flex-col items-center justify-center py-10 text-gray-400">
                                    <svg class="w-10 h-10 mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                    </svg>
                                    <p class="text-sm">Memuat notifikasi...</p>
                                </div>
                            </div>

                            {{-- Footer --}}
                            <a href="{{ route('user.history') }}" class="block px-5 py-3 text-center text-sm text-emerald-600 font-medium border-t border-gray-100 hover:bg-emerald-50 transition">
                                Lihat semua transaksi
                            </a>
                        </div>
                    </div>

                    {{-- Mobile Profile --}}
                    <div class="lg:hidden w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-emerald-100 flex items-center justify-center">
                        <span class="text-emerald-700 font-semibold text-xs">
                            {{ strtoupper(substr(auth()->user()->nama ?? 'U', 0, 1)) }}
                        </span>
                    </div>
                </div>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="flex-1 p-4 sm:p-6">
            @yield('content')
        </main>
    </div>

    {{-- ========================================== --}}
    {{-- MODAL KERANJANG (POP-UP) --}}
    {{-- ========================================== --}}
    <div id="cart-modal" class="fixed inset-0 z-[60] hidden">
        <div class="modal-overlay absolute inset-0" onclick="closeCartModal()"></div>

        <div class="absolute right-0 top-0 h-full w-full sm:w-[420px] bg-white shadow-2xl transform translate-x-full transition-transform duration-300 ease-out" id="cart-modal-content">

            {{-- Header --}}
            <div class="flex items-center justify-between p-6 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600" viewBox="0 0 24 24" fill="none">
                            <path d="M9 11V6C9 4.34315 10.3431 3 12 3C13.6569 3 15 4.34315 15 6V11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M4 11H20L18.5 20H5.5L4 11Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            <circle cx="8.5" cy="20.5" r="1.2" fill="currentColor"/>
                            <circle cx="15.5" cy="20.5" r="1.2" fill="currentColor"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Keranjang Belanja</h3>
                        <p class="text-sm text-gray-500"><span id="cart-count-text">0</span> item</p>
                    </div>
                </div>
                <button onclick="closeCartModal()" class="p-2 rounded-full hover:bg-gray-100 transition">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Cart Items --}}
            <div id="cart-items" class="flex-1 overflow-y-auto p-6 space-y-4" style="max-height: calc(100vh - 280px);">
                <div class="text-center py-12">
                    <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-gray-100 flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-300" viewBox="0 0 24 24" fill="none">
                            <path d="M9 11V6C9 4.34315 10.3431 3 12 3C13.6569 3 15 4.34315 15 6V11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M4 11H20L18.5 20H5.5L4 11Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <p class="text-gray-500">Keranjang masih kosong</p>
                    <button onclick="closeCartModal(); window.location.href='{{ route('user.katalog') }}'" class="mt-3 text-emerald-600 font-medium hover:underline">
                        Lihat Katalog
                    </button>
                </div>
            </div>

            {{-- Footer --}}
            <div class="absolute bottom-0 left-0 right-0 p-6 bg-white border-t border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-gray-600">Total</span>
                    <span class="text-xl font-bold text-gray-800" id="cart-total">Rp 0</span>
                </div>
                <button onclick="checkout()" class="w-full py-3 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-xl font-semibold hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2">
                    <span>Checkout</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- SCRIPTS --}}
    {{-- ========================================== --}}
    <script>
        // Toggle Sidebar Mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('mobile-overlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('hidden');
        }

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                document.getElementById('mobile-overlay').classList.add('hidden');
                document.getElementById('sidebar').classList.remove('open');
            }
        });

        // ═══════════════════════════════════════════════════════
        // POPUP NOTIFIKASI SYSTEM (Toast di kanan atas)
        // ═══════════════════════════════════════════════════════
        let shownPopupIds = new Set(); // Hindari popup duplikat

        /**
         * Tampilkan popup notifikasi
         */
        function showPopupNotif(data) {
            // Hindari duplikat
            if (shownPopupIds.has(data.id)) return;
            shownPopupIds.add(data.id);

            const container = document.getElementById('popup-container');
            const status = data.status || 'menunggu';
            const colorClass = `popup-${status}`;

            const popup = document.createElement('div');
            popup.className = `popup-notif ${colorClass} pointer-events-auto bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden`;
            popup.innerHTML = `
                <div class="flex items-start gap-3 p-4">
                    <div class="popup-icon w-10 h-10 rounded-full flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between gap-2">
                            <h4 class="font-semibold text-gray-800 text-sm leading-snug">${data.title || 'Notifikasi'}</h4>
                            <button onclick="closePopup(this)" class="text-gray-400 hover:text-gray-600 p-0.5 shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-0.5 leading-relaxed">${data.message || ''}</p>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="inline-block px-2 py-0.5 rounded-md text-[10px] font-medium bg-${data.status_color || 'gray'}-100 text-${data.status_color || 'gray'}-700">
                                ${data.status_label || status}
                            </span>
                            <span class="text-[10px] text-gray-400">${data.waktu || 'Baru saja'}</span>
                        </div>
                    </div>
                </div>
                <div class="popup-progress-bar h-0.5 bg-gray-200">
                    <div class="h-full bg-current opacity-30" style="color: inherit;"></div>
                </div>
            `;

            // Warna progress bar sesuai status
            const progressBar = popup.querySelector('.popup-progress-bar div');
            const statusColors = {
                menunggu: '#f59e0b',
                diproses: '#3b82f6',
                selesai: '#10b981',
                dibatalkan: '#ef4444'
            };
            progressBar.style.backgroundColor = statusColors[status] || '#6b7280';
            progressBar.classList.add('popup-progress-bar');

            container.appendChild(popup);

            // Auto close after 5 seconds
            const timeout = setTimeout(() => {
                closePopupElement(popup);
            }, 5000);

            // Pause on hover
            popup.addEventListener('mouseenter', () => {
                const bar = popup.querySelector('.popup-progress-bar div');
                bar.style.animationPlayState = 'paused';
            });
            popup.addEventListener('mouseleave', () => {
                const bar = popup.querySelector('.popup-progress-bar div');
                bar.style.animationPlayState = 'running';
            });

            // Click to go to detail
            popup.addEventListener('click', (e) => {
                if (e.target.closest('button')) return; // Jangan redirect kalau klik tombol close
                if (data.transaksi_id) {
                    window.location.href = '{{ url("history") }}/' + data.transaksi_id;
                }
            });
        }

        function closePopup(btn) {
            const popup = btn.closest('.popup-notif');
            closePopupElement(popup);
        }

        function closePopupElement(popup) {
            popup.classList.add('hiding');
            setTimeout(() => {
                if (popup.parentNode) popup.remove();
            }, 300);
        }

        // ═══════════════════════════════════════════════════════
        // NOTIFIKASI DROPDOWN (sama seperti sebelumnya)
        // ═══════════════════════════════════════════════════════
        let notifData = [];
        let notifDropdownOpen = false;

        function toggleNotifDropdown() {
            const dropdown = document.getElementById('notif-dropdown');
            const icon = document.getElementById('notif-icon');

            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
                notifDropdownOpen = true;
                icon.classList.add('notif-bell-ring');
                setTimeout(() => icon.classList.remove('notif-bell-ring'), 1000);
                loadNotifications();
            } else {
                dropdown.classList.add('hidden');
                notifDropdownOpen = false;
            }
        }

        document.addEventListener('click', function(e) {
            const container = document.getElementById('notif-container');
            const dropdown = document.getElementById('notif-dropdown');
            if (container && !container.contains(e.target) && notifDropdownOpen) {
                dropdown.classList.add('hidden');
                notifDropdownOpen = false;
            }
        });

        function loadNotifications() {
            const listEl = document.getElementById('notif-list');
            const subtitleEl = document.getElementById('notif-subtitle');

            fetch('{{ route("user.notifikasi") }}')
                .then(res => res.json())
                .then(data => {
                    notifData = data.notifications;
                    updateNotifBadge(data.unread_count);

                    // ═══════════════════════════════════════════════
                    // TAMPILKAN POPUP UNTUK NOTIF BARU (unread)
                    // ═══════════════════════════════════════════════
                    const unreadNotifs = notifData.filter(n => !n.read_at && !shownPopupIds.has(n.id));
                    unreadNotifs.forEach((notif, index) => {
                        setTimeout(() => {
                            showPopupNotif({
                                id: notif.id,
                                ...notif.data
                            });
                        }, index * 300); // Delay bertingkat biar nggak numpuk
                    });

                    if (notifData.length === 0) {
                        listEl.innerHTML = `
                            <div class="flex flex-col items-center justify-center py-10 text-gray-400">
                                <svg class="w-10 h-10 mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                                <p class="text-sm">Belum ada notifikasi</p>
                            </div>
                        `;
                        subtitleEl.textContent = 'Tidak ada notifikasi';
                        return;
                    }

                    subtitleEl.textContent = `${data.unread_count} belum dibaca`;

                    listEl.innerHTML = notifData.map(notif => {
                        const isUnread = !notif.read_at;
                        const bgClass = isUnread ? 'bg-emerald-50/60' : 'bg-white';
                        const dotClass = isUnread ? 'bg-emerald-500' : 'bg-gray-300';

                        return `
                            <div class="flex gap-3 px-5 py-3.5 hover:bg-gray-50 transition cursor-pointer border-b border-gray-50 ${bgClass}" 
                                 onclick="handleNotifClick('${notif.id}', ${notif.data.transaksi_id || 'null'})">
                                <div class="mt-0.5">
                                    <div class="w-2 h-2 rounded-full ${dotClass}"></div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-800 leading-snug">${notif.data.title || 'Notifikasi'}</p>
                                    <p class="text-xs text-gray-500 mt-0.5 leading-relaxed">${notif.data.message || ''}</p>
                                    <div class="flex items-center gap-2 mt-1.5">
                                        <span class="inline-block px-2 py-0.5 rounded-md text-[10px] font-medium bg-${notif.data.status_color || 'gray'}-100 text-${notif.data.status_color || 'gray'}-700">
                                            ${notif.data.status_label || notif.data.status || ''}
                                        </span>
                                        <span class="text-[10px] text-gray-400">${notif.data.waktu || notif.created_at}</span>
                                    </div>
                                </div>
                            </div>
                        `;
                    }).join('');
                })
                .catch(err => {
                    console.error('Error loading notifications:', err);
                });
        }

        function updateNotifBadge(count) {
            const badge = document.getElementById('notif-badge');
            if (count > 0) {
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }
        }

        function handleNotifClick(notifId, transaksiId) {
            fetch('{{ url("notifikasi/baca") }}/' + notifId, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(() => {
                if (transaksiId) {
                    window.location.href = '{{ url("history") }}/' + transaksiId;
                } else {
                    loadNotifications();
                }
            });
        }

        function markAllRead() {
            fetch('{{ route("user.notifikasi.baca-semua") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(() => loadNotifications())
            .catch(err => console.error('Error marking all read:', err));
        }

        // Load notif count + popup on page load
        document.addEventListener('DOMContentLoaded', function() {
            fetch('{{ route("user.notifikasi") }}')
                .then(res => res.json())
                .then(data => {
                    updateNotifBadge(data.unread_count);

                    // Tampilkan popup untuk notif unread
                    const unreadNotifs = data.notifications.filter(n => !n.read_at);
                    unreadNotifs.forEach((notif, index) => {
                        setTimeout(() => {
                            showPopupNotif({
                                id: notif.id,
                                ...notif.data
                            });
                        }, 500 + (index * 400));
                    });
                })
                .catch(err => console.error('Error loading initial notif:', err));
        });

        // Polling setiap 30 detik untuk notif baru
        setInterval(() => {
            fetch('{{ route("user.notifikasi") }}')
                .then(res => res.json())
                .then(data => {
                    updateNotifBadge(data.unread_count);
                    const newNotifs = data.notifications.filter(n => !n.read_at && !shownPopupIds.has(n.id));
                    newNotifs.forEach((notif, index) => {
                        setTimeout(() => {
                            showPopupNotif({
                                id: notif.id,
                                ...notif.data
                            });
                        }, index * 300);
                    });
                })
                .catch(err => console.error('Polling error:', err));
        }, 30000);

        // ==========================================
        // MODAL KERANJANG
        // ==========================================
        let cartData = [];

        function openCartModal() {
            const modal = document.getElementById('cart-modal');
            const content = document.getElementById('cart-modal-content');
            modal.classList.remove('hidden');
            setTimeout(() => content.classList.remove('translate-x-full'), 10);
            loadCartData();
        }

        function closeCartModal() {
            const modal = document.getElementById('cart-modal');
            const content = document.getElementById('cart-modal-content');
            content.classList.add('translate-x-full');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }

        function loadCartData() {
            fetch('{{ route("user.keranjang.data") }}')
                .then(res => res.json())
                .then(data => {
                    cartData = data.items;
                    renderCartItems(data);
                })
                .catch(err => {
                    console.error('Error loading cart:', err);
                    renderCartItems({ items: [], total_formatted: 'Rp 0', count: 0 });
                });
        }

        function renderCartItems(data) {
            const container = document.getElementById('cart-items');
            const countText = document.getElementById('cart-count-text');
            const totalEl = document.getElementById('cart-total');
            const badge = document.getElementById('cart-badge');

            badge.textContent = data.count;
            countText.textContent = data.count;
            totalEl.textContent = data.total_formatted;

            if (data.items.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-12">
                        <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-gray-100 flex items-center justify-center">
                            <svg class="w-10 h-10 text-gray-300" viewBox="0 0 24 24" fill="none">
                                <path d="M9 11V6C9 4.34315 10.3431 3 12 3C13.6569 3 15 4.34315 15 6V11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                <path d="M4 11H20L18.5 20H5.5L4 11Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <p class="text-gray-500">Keranjang masih kosong</p>
                        <button onclick="closeCartModal(); window.location.href='{{ route('user.katalog') }}'" class="mt-3 text-emerald-600 font-medium hover:underline">
                            Lihat Katalog
                        </button>
                    </div>
                `;
                return;
            }

            container.innerHTML = data.items.map((item, index) => `
                <div class="flex gap-4 p-4 rounded-xl bg-gray-50 border border-gray-100">
                    <div class="w-16 h-16 rounded-lg bg-emerald-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-start justify-between">
                            <div>
                                <h4 class="font-semibold text-gray-800 text-sm">${item.nama}</h4>
                                <p class="text-xs text-gray-500">${item.kategori}</p>
                            </div>
                            <button onclick="removeItem(${index})" class="text-red-400 hover:text-red-600 p-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <div class="flex items-center gap-2">
                                <button onclick="updateQty(${index}, -1)" class="w-6 h-6 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-100 text-sm">-</button>
                                <span class="text-sm font-medium w-6 text-center">${item.qty}</span>
                                <button onclick="updateQty(${index}, 1)" class="w-6 h-6 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-100 text-sm">+</button>
                            </div>
                            <span class="text-emerald-600 font-bold text-sm">${item.subtotal_formatted}</span>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function updateQty(index, change) {
            const item = cartData[index];
            if (!item) return;
            const newQty = Math.max(1, Math.min(10, item.qty + change));
            fetch('{{ url("keranjang/update") }}/' + index, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ qty: newQty })
            })
            .then(res => res.json())
            .then(() => loadCartData());
        }

        function removeItem(index) {
            fetch('{{ url("keranjang/hapus") }}/' + index, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                loadCartData();
                updateCartBadge(data.count);
            });
        }

        function addToCart(paketId, paketName) {
            fetch('{{ route("user.keranjang.tambah") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ paket_id: paketId, qty: 1 })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    updateCartBadge(data.count);
                    showToast(`${paketName} ditambahkan ke keranjang!`);
                } else {
                    showToast(data.message || 'Gagal menambahkan');
                }
            })
            .catch(err => {
                console.error('Error:', err);
                showToast('Gagal menambahkan ke keranjang');
            });
        }

        function updateCartBadge(count) {
            const badge = document.getElementById('cart-badge');
            badge.textContent = count;
            badge.classList.remove('cart-badge-animate');
            void badge.offsetWidth;
            badge.classList.add('cart-badge-animate');
        }

        function checkout() {
            if (cartData.length === 0) {
                showToast('Keranjang masih kosong!');
                return;
            }
            window.location.href = '{{ route("user.checkout") }}';
        }

        function showToast(message) {
            const toast = document.createElement('div');
            toast.className = 'fixed bottom-6 right-6 bg-gray-800 text-white px-6 py-3 rounded-xl shadow-lg z-[70] transform translate-y-10 opacity-0 transition-all duration-300 flex items-center gap-2';
            toast.innerHTML = `
                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                ${message}
            `;
            document.body.appendChild(toast);
            setTimeout(() => toast.classList.remove('translate-y-10', 'opacity-0'), 10);
            setTimeout(() => {
                toast.classList.add('translate-y-10', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
    </script>

    @yield('scripts')
</body>
</html>