<?php

namespace App\Http\Controllers;

use App\Models\JenisProduk;
use Illuminate\Http\Request;

class JenisProdukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $jenisProduks = JenisProduk::when($search, function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                      ->orWhere('deskripsi', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('jenis-produk.index', compact('jenisProduks'));
    }

    public function create()
    {
        return view('jenis-produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255|unique:jenis_produk,nama',
            'deskripsi' => 'nullable|string',
        ]);

        JenisProduk::create([
            'nama'      => $request->nama,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()
            ->route('jenis-produk.index')
            ->with('success', 'Jenis produk berhasil ditambahkan.');
    }

    public function edit(JenisProduk $jenisProduk)
    {
        return view('jenis-produk.edit', compact('jenisProduk'));
    }

    public function update(Request $request, JenisProduk $jenisProduk)
    {
        $request->validate([
            'nama'      => 'required|string|max:255|unique:jenis_produk,nama,' . $jenisProduk->id,
            'deskripsi' => 'nullable|string',
        ]);

        $jenisProduk->update([
            'nama'      => $request->nama,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()
            ->route('jenis-produk.index')
            ->with('success', 'Jenis produk berhasil diperbarui.');
    }

    public function destroy(JenisProduk $jenisProduk)
    {
        if ($jenisProduk->produk()->exists()) {
            return redirect()
                ->route('jenis-produk.index')
                ->with('error', 'Jenis produk tidak dapat dihapus karena masih digunakan oleh produk.');
        }

        $jenisProduk->delete();

        return redirect()
            ->route('jenis-produk.index')
            ->with('success', 'Jenis produk berhasil dihapus.');
    }
}
