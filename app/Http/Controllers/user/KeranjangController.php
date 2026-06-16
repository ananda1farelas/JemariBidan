<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    /**
     * Ambil data keranjang (AJAX)
     */
    public function data()
    {
        $keranjang = session('keranjang', []);
        $total = 0;
        $items = [];

        foreach ($keranjang as $id => $item) {
            $paket = Paket::find($item['paket_id']);
            if ($paket) {
                $subtotal = $paket->harga * $item['qty'];
                $total += $subtotal;
                $items[] = [
                    'id' => $id,
                    'paket_id' => $paket->id,
                    'nama' => $paket->nama,
                    'harga' => $paket->harga,
                    'harga_formatted' => $paket->harga_formatted,
                    'qty' => $item['qty'],
                    'subtotal' => $subtotal,
                    'subtotal_formatted' => 'Rp ' . number_format($subtotal, 0, ',', '.'),
                    'kategori' => $paket->kategori->nama ?? '',
                ];
            }
        }

        return response()->json([
            'items' => $items,
            'total' => $total,
            'total_formatted' => 'Rp ' . number_format($total, 0, ',', '.'),
            'count' => count($items),
        ]);
    }

    /**
     * Tambah item ke keranjang
     */
    public function tambah(Request $request)
    {
        $request->validate([
            'paket_id' => 'required|exists:pakets,id',
            'qty' => 'integer|min:1|max:10',
        ]);

        $paketId = $request->paket_id;
        $qty = $request->input('qty', 1);

        $keranjang = session('keranjang', []);

        // Cek kalo udah ada, tambah qty
        $found = false;
        foreach ($keranjang as $key => $item) {
            if ($item['paket_id'] == $paketId) {
                $keranjang[$key]['qty'] += $qty;
                $found = true;
                break;
            }
        }

        // Kalo belum ada, tambah baru
        if (!$found) {
            $keranjang[] = [
                'paket_id' => $paketId,
                'qty' => $qty,
            ];
        }

        session(['keranjang' => $keranjang]);

        return response()->json([
            'success' => true,
            'message' => 'Ditambahkan ke keranjang',
            'count' => count($keranjang),
        ]);
    }

    /**
     * Update qty item
     */
    public function update(Request $request, $index)
    {
        $request->validate([
            'qty' => 'required|integer|min:1|max:10',
        ]);

        $keranjang = session('keranjang', []);

        if (isset($keranjang[$index])) {
            $keranjang[$index]['qty'] = $request->qty;
            session(['keranjang' => $keranjang]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Hapus item dari keranjang
     */
    public function hapus($index)
    {
        $keranjang = session('keranjang', []);

        if (isset($keranjang[$index])) {
            unset($keranjang[$index]);
            $keranjang = array_values($keranjang);
            session(['keranjang' => $keranjang]);
        }

        return response()->json([
            'success' => true,
            'count' => count($keranjang),
        ]);
    }

    /**
     * Kosongkan keranjang
     */
    public function kosongkan()
    {
        session()->forget('keranjang');
        return response()->json(['success' => true]);
    }
}   