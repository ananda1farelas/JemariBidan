@extends('layouts.user')

@section('title', 'Dashboard - Jemari Bidan')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">

    {{-- Welcome Banner --}}
    <div class="relative overflow-hidden bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl p-8 text-white shadow-lg">
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
        <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
        
        <div class="relative z-10">
            <h2 class="text-2xl font-bold mb-2">Selamat Datang, {{ auth()->user()->nama ?? 'Bunda' }}! 👋</h2>
            <p class="text-emerald-100 mb-4">Temukan treatment terbaik untuk ibu dan si kecil hanya di Jemari Bidan.</p>
            <a href="{{ route('user.katalog') }}" class="inline-flex items-center gap-2 bg-white text-emerald-600 px-6 py-2.5 rounded-full font-semibold hover:bg-emerald-50 transition shadow-md">
                Lihat Katalog
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition">
            ...
            <h3 class="text-2xl font-bold text-gray-800">{{ $totalTransaksi }}</h3>
            <p class="text-gray-500 text-sm mt-1">Total Transaksi</p>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition">
            ...
            <h3 class="text-2xl font-bold text-gray-800">{{ $treatmentAktif }}</h3>
            <p class="text-gray-500 text-sm mt-1">Treatment Berlangsung</p>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition">
            ...
            <h3 class="text-2xl font-bold text-gray-800">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h3>
            <p class="text-gray-500 text-sm mt-1">Total Pengeluaran</p>
        </div>
    </div>

    {{-- Treatment Populer & Side Content --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- Treatment Populer --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Treatment Populer</h3>
                    <p class="text-sm text-gray-500">Pilihan favorit para bunda</p>
                </div>
                <a href="{{ route('user.katalog') }}" class="text-emerald-600 text-sm font-medium hover:underline">Lihat Semua</a>
            </div>
            
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                {{-- Baby Massage --}}
                <div class="group relative bg-gradient-to-br from-emerald-50 to-teal-50 rounded-xl p-5 border border-emerald-100 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-start justify-between mb-3">
                        <div class="w-10 h-10 rounded-lg bg-emerald-500 flex items-center justify-center text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-emerald-700 font-bold">Rp 60.000</span>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-1">Baby Massage</h4>
                    <p class="text-sm text-gray-500 mb-3">Pijat bayi 0-11 bulan dengan minyak EVCO</p>
                    <button onclick="addToCart('Baby Massage')" class="w-full py-2 bg-emerald-500 text-white rounded-lg text-sm font-medium hover:bg-emerald-600 transition flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah ke Keranjang
                    </button>
                </div>

                {{-- Mom Treatment --}}
                <div class="group relative bg-gradient-to-br from-pink-50 to-rose-50 rounded-xl p-5 border border-pink-100 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-start justify-between mb-3">
                        <div class="w-10 h-10 rounded-lg bg-pink-500 flex items-center justify-center text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <span class="text-pink-700 font-bold">Rp 160.000</span>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-1">Mom Treatment</h4>
                    <p class="text-sm text-gray-500 mb-3">Calm Mom - Pijat & relaksasi untuk bunda</p>
                    <button onclick="addToCart('Mom Treatment')" class="w-full py-2 bg-pink-500 text-white rounded-lg text-sm font-medium hover:bg-pink-600 transition flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah ke Keranjang
                    </button>
                </div>

                {{-- Newborn Care --}}
                <div class="group relative bg-gradient-to-br from-sky-50 to-blue-50 rounded-xl p-5 border border-sky-100 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-start justify-between mb-3">
                        <div class="w-10 h-10 rounded-lg bg-sky-500 flex items-center justify-center text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <span class="text-sky-700 font-bold">Rp 85.000</span>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-1">Newborn Care</h4>
                    <p class="text-sm text-gray-500 mb-3">Perawatan bayi baru lahir (1x pertemuan)</p>
                    <button onclick="addToCart('Newborn Care')" class="w-full py-2 bg-sky-500 text-white rounded-lg text-sm font-medium hover:bg-sky-600 transition flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah ke Keranjang
                    </button>
                </div>

                {{-- Pendampingan Persalinan --}}
                <div class="group relative bg-gradient-to-br from-violet-50 to-purple-50 rounded-xl p-5 border border-violet-100 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-start justify-between mb-3">
                        <div class="w-10 h-10 rounded-lg bg-violet-500 flex items-center justify-center text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-violet-700 font-bold">Rp 750.000</span>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-1">Pendampingan Persalinan</h4>
                    <p class="text-sm text-gray-500 mb-3">Copper Package - Dampingi persalinan bunda</p>
                    <button onclick="addToCart('Pendampingan Persalinan')" class="w-full py-2 bg-violet-500 text-white rounded-lg text-sm font-medium hover:bg-violet-600 transition flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah ke Keranjang
                    </button>
                </div>
            </div>
        </div>

        {{-- Right Column --}}
        <div class="space-y-6">
            
            {{-- Info Promo (ganti dari jadwal dummy) --}}
            <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl p-6 text-white">
                <h3 class="text-lg font-bold mb-2 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                    Promo Spesial
                </h3>
                <p class="text-emerald-100 text-sm mb-3">Diskon 10% untuk pendampingan persalinan paket Gold!</p>
                <a href="{{ route('user.katalog.kategori', 'mom') }}" class="inline-block bg-white text-emerald-600 px-4 py-2 rounded-lg text-sm font-bold hover:bg-emerald-50 transition">
                    Lihat Paket
                </a>
            </div>

            {{-- Artikel Terbaru --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                    Artikel Terbaru
                </h3>
                
                <div class="space-y-4">
                    <a href="#" class="block group">
                        <div class="flex gap-3">
                            <div class="w-16 h-16 rounded-lg bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-gray-800 group-hover:text-emerald-600 transition line-clamp-2">Manfaat Pijat Bayi untuk Tumbuh Kembang</h4>
                                <p class="text-xs text-gray-500 mt-1">5 menit baca</p>
                            </div>
                        </div>
                    </a>
                    
                    <a href="#" class="block group">
                        <div class="flex gap-3">
                            <div class="w-16 h-16 rounded-lg bg-pink-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-gray-800 group-hover:text-emerald-600 transition line-clamp-2">Tips Menjaga Kesehatan Ibu Hamil Trimester 3</h4>
                                <p class="text-xs text-gray-500 mt-1">8 menit baca</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <a href="{{ route('user.artikel') }}" class="mt-4 block text-center text-sm text-emerald-600 font-medium hover:underline">Baca Artikel Lainnya</a>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Aksi Cepat</h3>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <a href="{{ route('user.katalog') }}" class="flex flex-col items-center gap-3 p-4 rounded-xl bg-emerald-50 hover:bg-emerald-100 transition text-center">
                <div class="w-12 h-12 rounded-full bg-emerald-500 flex items-center justify-center text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-700">Pesan Treatment</span>
            </a>
            
            <a href="{{ route('user.history') }}" class="flex flex-col items-center gap-3 p-4 rounded-xl bg-blue-50 hover:bg-blue-100 transition text-center">
                <div class="w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-700">Riwayat</span>
            </a>
            
            <a href="#" class="flex flex-col items-center gap-3 p-4 rounded-xl bg-amber-50 hover:bg-amber-100 transition text-center">
                <div class="w-12 h-12 rounded-full bg-amber-500 flex items-center justify-center text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-700">Hubungi Kami</span>
            </a>
            
            <a href="{{ route('user.artikel') }}" class="flex flex-col items-center gap-3 p-4 rounded-xl bg-purple-50 hover:bg-purple-100 transition text-center">
                <div class="w-12 h-12 rounded-full bg-purple-500 flex items-center justify-center text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-700">Baca Artikel</span>
            </a>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    function addToCart(treatmentName) {
        const badge = document.getElementById('cart-badge');
        let currentCount = parseInt(badge.textContent);
        badge.textContent = currentCount + 1;
        
        badge.classList.remove('cart-badge-animate');
        void badge.offsetWidth;
        badge.classList.add('cart-badge-animate');
        
        showToast(`${treatmentName} ditambahkan ke keranjang!`);
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
        
        setTimeout(() => {
            toast.classList.remove('translate-y-10', 'opacity-0');
        }, 10);
        
        setTimeout(() => {
            toast.classList.add('translate-y-10', 'opacity-0');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
</script>
@endsection