<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Tampilkan halaman checkout
     */
    public function index()
    {
        $keranjang = session('keranjang', []);
        
        if (empty($keranjang)) {
            return redirect()->route('user.katalog')
                ->with('error', 'Keranjang masih kosong. Silakan pilih treatment terlebih dahulu.');
        }

        $items = [];
        $total = 0;

        foreach ($keranjang as $item) {
            $paket = Paket::with('kategori')->find($item['paket_id']);
            if ($paket) {
                $subtotal = $paket->harga * $item['qty'];
                $total += $subtotal;
                $items[] = [
                    'paket' => $paket,
                    'qty' => $item['qty'],
                    'subtotal' => $subtotal,
                ];
            }
        }

        $user = auth()->user();

        return view('user.checkout.index', [
            'items' => $items,
            'total' => $total,
            'totalFormatted' => 'Rp ' . number_format($total, 0, ',', '.'),
            'user' => $user,
            'cartCount' => count($keranjang),
        ]);
    }

    /**
     * Proses checkout & simpan transaksi
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'tanggal' => 'required|date|after_or_equal:today',
            'catatan' => 'nullable|string',
        ]);

        $keranjang = session('keranjang', []);

        if (empty($keranjang)) {
            return redirect()->route('user.katalog')
                ->with('error', 'Keranjang masih kosong.');
        }

        // Hitung total
        $total = 0;
        $details = [];

        foreach ($keranjang as $item) {
            $paket = Paket::find($item['paket_id']);
            if ($paket) {
                $subtotal = $paket->harga * $item['qty'];
                $total += $subtotal;
                $details[] = [
                    'paket' => $paket,
                    'qty' => $item['qty'],
                    'harga_satuan' => $paket->harga,
                    'subtotal' => $subtotal,
                ];
            }
        }

        // Generate kode transaksi
        $kode = 'TRX-' . now()->format('Ymd') . '-' . strtoupper(Str::random(3));

        // Simpan transaksi
        $transaksi = Transaksi::create([
            'user_id' => auth()->id(),
            'kode_transaksi' => $kode,
            'total_harga' => $total,
            'status' => 'menunggu',
            'catatan' => $request->catatan,
            'tanggal_transaksi' => now(),
        ]);

        // Simpan detail
        foreach ($details as $detail) {
            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'paket_id' => $detail['paket']->id,
                'qty' => $detail['qty'],
                'harga_satuan' => $detail['harga_satuan'],
                'subtotal' => $detail['subtotal'],
            ]);
        }

        // Kosongkan keranjang
        session()->forget('keranjang');

        return redirect()->route('user.history')
            ->with('success', 'Pesanan berhasil dibuat! Kode transaksi: ' . $kode);
    }
}