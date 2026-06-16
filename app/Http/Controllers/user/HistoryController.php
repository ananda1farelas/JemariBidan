<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;

class HistoryController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::where('user_id', auth()->id())
            ->with(['details.paket', 'details.paket.kategori'])
            ->orderBy('tanggal_transaksi', 'desc')
            ->paginate(10);

        return view('user.history.index', [
            'transaksis' => $transaksis,
            'cartCount' => count(session('keranjang', [])),
        ]);
    }

    /**
     * Detail transaksi (Invoice)
     */
    public function show($id)
    {
        $transaksi = Transaksi::where('id', $id)
            ->where('user_id', auth()->id())
            ->with(['details.paket.kategori', 'user'])
            ->firstOrFail();

        return view('user.history.show', [
            'transaksi' => $transaksi,
            'cartCount' => count(session('keranjang', [])),
        ]);
    }
}