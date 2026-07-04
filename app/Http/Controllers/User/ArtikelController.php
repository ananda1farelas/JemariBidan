<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Artikel;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::where('publish', true)
            ->orderBy('created_at', 'desc')
            ->get();

        // Kategori count
        $kategoris = [
            'semua' => $artikels->count(),
            'ibu' => $artikels->where('kategori', 'ibu')->count(),
            'bayi' => $artikels->where('kategori', 'bayi')->count(),
            'gizi' => $artikels->where('kategori', 'gizi')->count(),
        ];

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