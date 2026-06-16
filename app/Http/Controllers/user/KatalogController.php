<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Paket;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    /**
     * Step 1: Halaman utama katalog - list kategori
     */
    public function index()
    {
        $kategoris = Kategori::withCount('pakets')
            ->orderBy('urutan')
            ->get();

        return view('user.katalog.index', [
            'kategoris' => $kategoris,
            'cartCount' => session('keranjang', []) ? count(session('keranjang')) : 0,
        ]);
    }

    /**
     * Step 2: Halaman kategori - list paket dalam kategori
     */
    public function kategori(string $slug)
    {
        $kategori = Kategori::where('slug', $slug)
            ->with(['pakets' => fn($q) => $q->where('aktif', true)->orderBy('harga')])
            ->firstOrFail();

        return view('user.katalog.kategori', [
            'kategori' => $kategori,
            'cartCount' => session('keranjang', []) ? count(session('keranjang')) : 0,
        ]);
    }

    /**
     * Step 3: Detail paket
     */
    public function detail(string $kategoriSlug, string $paketSlug)
    {
        $kategori = Kategori::where('slug', $kategoriSlug)->firstOrFail();
        
        $paket = Paket::where('slug', $paketSlug)
            ->where('kategori_id', $kategori->id)
            ->where('aktif', true)
            ->firstOrFail();

        // Paket lain dalam kategori yang sama (untuk "Lihat Juga")
        $related = Paket::where('kategori_id', $kategori->id)
            ->where('id', '!=', $paket->id)
            ->where('aktif', true)
            ->limit(3)
            ->get();

        return view('user.katalog.detail', [
            'paket' => $paket,
            'kategori' => $kategori,
            'related' => $related,
            'cartCount' => session('keranjang', []) ? count(session('keranjang')) : 0,
        ]);
    }
}