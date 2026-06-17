<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.artikel.index', [
            'artikels' => $artikels,
        ]);
    }

    public function create()
    {
        return view('admin.artikel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'kategori' => 'required|string|in:ibu,bayi,gizi,umum',
            'gambar' => 'nullable|string',
        ]);

        Artikel::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'konten' => $request->konten,
            'excerpt' => substr(strip_tags($request->konten), 0, 150) . '...',
            'kategori' => $request->kategori,
            'gambar' => $request->gambar,
            'publish' => $request->boolean('publish', true),
        ]);

        return redirect()->route('admin.artikel')->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $artikel = Artikel::findOrFail($id);
        
        return view('admin.artikel.edit', [
            'artikel' => $artikel,
        ]);
    }

    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'kategori' => 'required|string|in:ibu,bayi,gizi,umum',
            'gambar' => 'nullable|string',
        ]);

        $artikel->update([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'konten' => $request->konten,
            'excerpt' => substr(strip_tags($request->konten), 0, 150) . '...',
            'kategori' => $request->kategori,
            'gambar' => $request->gambar,
            'publish' => $request->boolean('publish', false),
        ]);

        return redirect()->route('admin.artikel')->with('success', 'Artikel berhasil diupdate!');
    }

    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);
        $artikel->delete();

        return redirect()->route('admin.artikel')->with('success', 'Artikel berhasil dihapus!');
    }
}