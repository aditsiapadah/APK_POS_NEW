<?php

namespace App\Http\Controllers;

use App\Models\ItemPenjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $produk = Produk::when($search, function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                      ->orWhere('jenis_produk', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('produk.index', compact('produk'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required|string|max:255',
            'jenis_produk'  => 'required|string|max:255',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'harga_beli'    => 'required|numeric|min:0',
            'harga_jual'    => 'required|numeric|min:0',
            'stok'          => 'required|integer|min:0',
        ]);

        $foto = null;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('produk', 'public');
        }

        Produk::create([
            'user_id'       => Auth::id(),
            'nama'          => $request->nama,
            'jenis_produk'  => $request->jenis_produk,
            'foto'          => $foto,
            'harga_beli'    => $request->harga_beli,
            'harga_jual'    => $request->harga_jual,
            'stok'          => $request->stok,
        ]);

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Produk $produk)
    {
        return view('produk.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama'          => 'required|string|max:255',
            'jenis_produk'  => 'required|string|max:255',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'harga_beli'    => 'required|numeric|min:0',
            'harga_jual'    => 'required|numeric|min:0',
            'stok'          => 'required|integer|min:0',
        ]);

        if ($request->hasFile('foto')) {

            if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
                Storage::disk('public')->delete($produk->foto);
            }

            $produk->foto = $request->file('foto')->store('produk', 'public');
        }

        $produk->user_id = $produk->user_id ?? Auth::id();
        $produk->nama = $request->nama;
        $produk->jenis_produk = $request->jenis_produk;
        $produk->harga_beli = $request->harga_beli;
        $produk->harga_jual = $request->harga_jual;
        $produk->stok = $request->stok;

        $produk->save();

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        $digunakan = ItemPenjualan::where('produk_id', $produk->id)->exists();

        if ($digunakan) {
            return redirect()
                ->route('produk.index')
                ->with('error', 'Produk sedang digunakan pada transaksi dan tidak dapat dihapus.');
        }

        if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
            Storage::disk('public')->delete($produk->foto);
        }

        $produk->delete();

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}