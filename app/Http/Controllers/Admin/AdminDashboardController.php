<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\Paket;
use App\Models\Artikel;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'totalUser' => User::where('role', 'user')->count(),
            'totalTransaksi' => Transaksi::count(),
            'totalPendapatan' => Transaksi::where('status', 'selesai')->sum('total_harga'),
            'totalProduk' => Paket::count(),
            'totalArtikel' => Artikel::where('publish', true)->count(),
        ];

        // Transaksi terbaru
        $transaksiTerbaru = Transaksi::with('user')
            ->orderBy('tanggal_transaksi', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', [
            'stats' => $stats,
            'transaksiTerbaru' => $transaksiTerbaru,
        ]);
    }
}