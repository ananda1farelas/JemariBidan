<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProdukController extends Controller
{
    // ========== KATEGORI ==========
    public function index()
    {
        return view('admin.produk.index');
    }
    
    public function kategoriIndex()
    {
        $kategoris = Kategori::orderBy('urutan')->paginate(10);
        return view('admin.produk.kategori.index', compact('kategoris'));
    }

    public function kategoriCreate()
    {
        return view('admin.produk.kategori.create');
    }

    public function kategoriStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:kategoris',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|string|max:500',
            'urutan' => 'nullable|integer',
        ]);

        Kategori::create([
            'nama' => $request->nama,
            'slug' => Str::slug($request->slug),
            'deskripsi' => $request->deskripsi,
            'gambar' => $request->gambar,
            'urutan' => $request->urutan ?? 0,
        ]);

        return redirect()->route('admin.produk.kategori')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function kategoriEdit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.produk.kategori.edit', compact('kategori'));
    }

    public function kategoriUpdate(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:kategoris,slug,' . $id,
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|string|max:500',
            'urutan' => 'nullable|integer',
        ]);

        $kategori->update([
            'nama' => $request->nama,
            'slug' => Str::slug($request->slug),
            'deskripsi' => $request->deskripsi,
            'gambar' => $request->gambar,
            'urutan' => $request->urutan ?? 0,
        ]);

        return redirect()->route('admin.produk.kategori')->with('success', 'Kategori berhasil diupdate!');
    }

    public function kategoriDestroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('admin.produk.kategori')->with('success', 'Kategori berhasil dihapus!');
    }

    // ========== PAKET ==========
    
    public function paketIndex()
    {
        $pakets = Paket::with('kategori')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.produk.paket.index', compact('pakets'));
    }

    public function paketCreate()
    {
        $kategoris = Kategori::orderBy('urutan')->get();
        return view('admin.produk.paket.create', compact('kategoris'));
    }

    public function paketStore(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pakets',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'durasi' => 'required|integer|min:1',
            'fitur' => 'nullable|string',
            'gambar' => 'nullable|string|max:500',
            'aktif' => 'nullable',
        ]);

        // Parse fitur dari textarea (satu fitur per baris)
        $fiturArray = [];
        if ($request->fitur) {
            $fiturArray = array_filter(array_map('trim', explode("\n", $request->fitur)));
        }

        Paket::create([
            'kategori_id' => $request->kategori_id,
            'nama' => $request->nama,
            'slug' => Str::slug($request->slug),
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'durasi' => $request->durasi,
            'fitur' => $fiturArray,
            'gambar' => $request->gambar,
            'aktif' => $request->boolean('aktif', true),
        ]);

        return redirect()->route('admin.produk.paket')->with('success', 'Paket berhasil ditambahkan!');
    }

    public function paketEdit($id)
    {
        $paket = Paket::findOrFail($id);
        $kategoris = Kategori::orderBy('urutan')->get();
        return view('admin.produk.paket.edit', compact('paket', 'kategoris'));
    }

    public function paketUpdate(Request $request, $id)
    {
        $paket = Paket::findOrFail($id);

        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pakets,slug,' . $id,
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'durasi' => 'required|integer|min:1',
            'fitur' => 'nullable|string',
            'gambar' => 'nullable|string|max:500',
            'aktif' => 'nullable',
        ]);

        // Parse fitur dari textarea
        $fiturArray = [];
        if ($request->fitur) {
            $fiturArray = array_filter(array_map('trim', explode("\n", $request->fitur)));
        }

        $paket->update([
            'kategori_id' => $request->kategori_id,
            'nama' => $request->nama,
            'slug' => Str::slug($request->slug),
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'durasi' => $request->durasi,
            'fitur' => $fiturArray,
            'gambar' => $request->gambar,
            'aktif' => $request->boolean('aktif', false),
        ]);

        return redirect()->route('admin.produk.paket')->with('success', 'Paket berhasil diupdate!');
    }

    public function paketDestroy($id)
    {
        $paket = Paket::findOrFail($id);
        $paket->delete();

        return redirect()->route('admin.produk.paket')->with('success', 'Paket berhasil dihapus!');
    }
}