<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;

class UserDashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Real data dari database
        $totalTransaksi = Transaksi::where('user_id', $userId)->count();
        
        $treatmentAktif = Transaksi::where('user_id', $userId)
            ->where('status', 'diproses')
            ->count();
        
        $totalPengeluaran = Transaksi::where('user_id', $userId)
            ->where('status', 'selesai')
            ->sum('total_harga');

        // Kalo belum ada transaksi, tampilkan 0 (bukan dummy)
        $cartCount = count(session('keranjang', []));

        return view('user.dashboard', [
            'totalTransaksi' => $totalTransaksi,
            'treatmentAktif' => $treatmentAktif,
            'totalPengeluaran' => $totalPengeluaran,
            'cartCount' => $cartCount,
        ]);
    }
}