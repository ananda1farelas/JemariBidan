<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with(['details.paket'])
            ->where('user_id', auth()->id())
            ->orderBy('tanggal_transaksi', 'desc')
            ->paginate(10);

        return view('user.history.index', compact('transaksis'));
    }

    public function show($id)
    {
        $transaksi = Transaksi::with(['details.paket.kategori', 'user'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('user.history.show', compact('transaksi'));
    }
}