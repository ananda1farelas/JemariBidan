<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\User;
use App\Notifications\StatusTransaksiUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminTransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::with(['user', 'details.paket'])->orderBy('tanggal_transaksi', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('dari')) {
            $query->whereDate('tanggal_transaksi', '>=', $request->dari);
        }
        if ($request->filled('sampai')) {
            $query->whereDate('tanggal_transaksi', '<=', $request->sampai);
        }

        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->where(function ($q) use ($cari) {
                $q->where('kode_transaksi', 'like', "%{$cari}%")
                  ->orWhereHas('user', function ($uq) use ($cari) {
                      $uq->where('name', 'like', "%{$cari}%");
                  });
            });
        }

        $transaksis = $query->paginate(10)->withQueryString();

        return view('admin.transaksi.index', compact('transaksis'));
    }

    public function show($id)
    {
        $transaksi = Transaksi::with(['user', 'details.paket.kategori'])->findOrFail($id);
        return view('admin.transaksi.show', compact('transaksi'));
    }

    public function edit($id)
    {
        $transaksi = Transaksi::with(['user', 'details.paket'])->findOrFail($id);
        return view('admin.transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::with('user')->findOrFail($id);

        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,dibatalkan',
            'catatan' => 'nullable|string|max:500',
        ]);

        $statusLama = $transaksi->status;

        // Jangan kirim notif kalau status sama
        if ($statusLama === $request->status) {
            $transaksi->update([
                'catatan' => $request->catatan,
            ]);
            return redirect()->route('admin.transaksi')->with('success', 'Catatan transaksi diupdate!');
        }

        $transaksi->update([
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        // ─── KIRIM NOTIFIKASI KE USER ───
        if ($transaksi->user) {
            $transaksi->user->notify(new StatusTransaksiUpdated($transaksi, $statusLama));
        }

        return redirect()->route('admin.transaksi')->with('success', 'Status transaksi diupdate & notifikasi terkirim!');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('admin.transaksi')->with('success', 'Transaksi dihapus!');
    }
}