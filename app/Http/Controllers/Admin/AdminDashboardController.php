<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\Paket;
use App\Models\Artikel;
use App\Models\DetailTransaksi;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $startOfWeek = $now->copy()->startOfWeek();
        $startOfMonth = $now->copy()->startOfMonth();

        // ═══ STATS UTAMA ═══
        $stats = [
            'totalUser' => User::where('role', 'user')->count(),
            'totalTransaksi' => Transaksi::count(),
            'totalPendapatan' => Transaksi::where('status', 'selesai')->sum('total_harga'),
            'totalProduk' => Paket::count(),
            'totalArtikel' => Artikel::where('publish', true)->count(),
            // Status breakdown
            'menunggu' => Transaksi::where('status', 'menunggu')->count(),
            'diproses' => Transaksi::where('status', 'diproses')->count(),
            'selesai' => Transaksi::where('status', 'selesai')->count(),
            'dibatalkan' => Transaksi::where('status', 'dibatalkan')->count(),
        ];

        // ═══ GROWTH MINGGU INI ═══
        $newUsersThisWeek = User::where('role', 'user')
            ->where('created_at', '>=', $startOfWeek)
            ->count();

        $newTransaksiThisWeek = Transaksi::where('created_at', '>=', $startOfWeek)->count();

        $pendapatanMingguLalu = Transaksi::where('status', 'selesai')
            ->whereBetween('created_at', [$startOfWeek->copy()->subWeek(), $startOfWeek])
            ->sum('total_harga') ?: 1; // hindari division by zero

        $pendapatanThisWeek = Transaksi::where('status', 'selesai')
            ->where('created_at', '>=', $startOfWeek)
            ->sum('total_harga');

        $pendapatanGrowth = $pendapatanMingguLalu > 0 
            ? round((($pendapatanThisWeek - $pendapatanMingguLalu) / $pendapatanMingguLalu) * 100) 
            : 0;

        // ═══ RINGKASAN BULAN INI ═══
        $bulanIniTransaksi = Transaksi::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        $bulanIniPendapatan = Transaksi::where('status', 'selesai')
            ->whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->sum('total_harga');

        $bulanIniUser = User::where('role', 'user')
            ->whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        // ═══ CHART DATA (7 hari terakhir) ═══
        $chartData = [];
        $maxValue = 0;

        for ($i = 6; $i >= 0; $i--) {
            $date = $now->copy()->subDays($i);
            
            // Ganti 'created_at' menjadi 'tanggal_transaksi'
            $value = Transaksi::where('status', 'selesai')
                ->whereDate('tanggal_transaksi', $date) 
                ->sum('total_harga');

            $chartData[] = [
                'label' => $date->format('D'),
                'value' => $value,
                'date' => $date->format('d M'),
            ];

            if ($value > $maxValue) $maxValue = $value;
        }

        // Hitung persentase untuk chart height
        foreach ($chartData as &$day) {
            $day['percent'] = $maxValue > 0 ? max(10, ($day['value'] / $maxValue) * 100) : 10;
        }

        // ═══ TRANSAKSI PENDING ═══
        $pendingTransaksi = Transaksi::with(['user', 'details'])
            ->where('status', 'menunggu')
            ->orderBy('tanggal_transaksi', 'desc')
            ->limit(5)
            ->get();

        // ═══ TRANSAKSI TERBARU (untuk aktivitas) ═══
        $transaksiTerbaru = Transaksi::with('user')
            ->orderBy('tanggal_transaksi', 'desc')
            ->limit(10)
            ->get();

        // Format aktivitas
        $recentActivities = [];
        foreach ($transaksiTerbaru as $t) {
            $recentActivities[] = [
                'color' => $this->getStatusColor($t->status),
                'icon' => $this->getStatusIcon($t->status),
                'message' => $this->getActivityMessage($t),
                'time' => $t->tanggal_transaksi->diffForHumans(),
            ];
        }

        // ═══ TOP PRODUK ═══
        $topProduk = DetailTransaksi::selectRaw('paket_id, SUM(qty) as terjual, SUM(subtotal) as pendapatan')
            ->groupBy('paket_id')
            ->orderByDesc('terjual')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                $paket = Paket::find($item->paket_id);
                return [
                    'nama' => $paket ? $paket->nama : 'Produk #' . $item->paket_id,
                    'terjual' => $item->terjual,
                    'pendapatan' => $item->pendapatan,
                ];
            });

        // ═══ JUMLAH KATEGORI ═══
        $kategoriCount = \App\Models\Kategori::count();

        return view('admin.dashboard', compact(
            'stats',
            'newUsersThisWeek',
            'newTransaksiThisWeek',
            'pendapatanGrowth',
            'bulanIniTransaksi',
            'bulanIniPendapatan',
            'bulanIniUser',
            'chartData',
            'pendingTransaksi',
            'recentActivities',
            'topProduk',
            'kategoriCount',
            'transaksiTerbaru'
        ));
    }

    private function getStatusColor($status)
    {
        return [
            'menunggu' => 'amber',
            'diproses' => 'blue',
            'selesai' => 'emerald',
            'dibatalkan' => 'red',
        ][$status] ?? 'gray';
    }

    private function getStatusIcon($status)
    {
        $icons = [
            'menunggu' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>',
            'diproses' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
            'selesai' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
            'dibatalkan' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
        ];
        return $icons[$status] ?? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>';
    }

    private function getActivityMessage($transaksi)
    {
        $userName = $transaksi->user->nama ?? 'User';
        $statusLabels = [
            'menunggu' => 'membuat pesanan baru',
            'diproses' => 'pesanannya sedang diproses',
            'selesai' => 'pesanannya telah selesai',
            'dibatalkan' => 'membatalkan pesanan',
        ];
        return $userName . ' ' . ($statusLabels[$transaksi->status] ?? 'melakukan transaksi');
    }
}