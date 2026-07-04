<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Artikel;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil SEMUA artikel yang di-publish dulu (buat ngitung total kategori)
        $semuaArtikel = Artikel::where('publish', true)
            ->orderBy('created_at', 'desc')
            ->get();
    
        // 2. Hitung jumlah per kategori (dari semua artikel, bukan yang difilter)
        $kategoris = [
            'semua' => $semuaArtikel->count(),
            'ibu' => $semuaArtikel->where('kategori', 'ibu')->count(),
            'bayi' => $semuaArtikel->where('kategori', 'bayi')->count(),
            'gizi' => $semuaArtikel->where('kategori', 'gizi')->count(),
        ];
    
        // 3. Filter data artikel yang mau ditampilin sesuai tombol yang diklik
        if ($request->has('kategori')) {
            // Kalau ada parameter ?kategori di URL, saring datanya
            $artikels = $semuaArtikel->where('kategori', $request->kategori);
        } else {
            // Kalau nggak ada (tampil semua)
            $artikels = $semuaArtikel;
        }
    
        return view('user.artikel.index', [
            'artikels' => $artikels,
            'kategoris' => $kategoris,
            'cartCount' => count(session('keranjang', [])),
        ]);
    }

    public function show(string $slug)
    {
        $artikel = Artikel::where('slug', $slug)->where('publish', true)->firstOrFail();
        
        // Increment view
        $artikel->increment('dibaca');

        // Related artikel
        $related = Artikel::where('kategori', $artikel->kategori)
            ->where('id', '!=', $artikel->id)
            ->where('publish', true)
            ->limit(3)
            ->get();

        return view('user.artikel.show', [
            'artikel' => $artikel,
            'related' => $related,
            'cartCount' => count(session('keranjang', [])),
        ]);
    }
}
