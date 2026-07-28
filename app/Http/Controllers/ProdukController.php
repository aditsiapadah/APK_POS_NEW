<?php

namespace App\Http\Controllers;

use App\Models\ItemPenjualan;
use App\Models\Produk;
<<<<<<< HEAD
<<<<<<< HEAD
=======
use App\Models\ItemPenjualan;
>>>>>>> 49def9d (update projek)
=======
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
>>>>>>> e5fa7ac (Update fitur baru)

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
            'harga_beli'    => 'required|numeric',
            'harga_jual'    => 'required|numeric',
            'stok'          => 'required|numeric',
        ]);

        // Jika ada foto baru
        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
                Storage::disk('public')->delete($produk->foto);
            }

            // Upload foto baru
            $produk->foto = $request->file('foto')->store('produk', 'public');
        }

        $produk->nama = $request->nama;
        $produk->jenis_produk = $request->jenis_produk;
        $produk->harga_beli = $request->harga_beli;
        $produk->harga_jual = $request->harga_jual;
        $produk->stok = $request->stok;

        $produk->save();

        return redirect()
            ->route('produk.index')
<<<<<<< HEAD
<<<<<<< HEAD
            ->with('success','Produk berhasil diperbarui');
    }

}
=======
            ->with('success', 'Produk berhasil diperbarui');
    }

=======
            ->with('success', 'Produk berhasil diperbarui.');
    }

>>>>>>> e5fa7ac (Update fitur baru)
    public function destroy(Produk $produk)
    {
        $digunakan = ItemPenjualan::where('produk_id', $produk->id)->exists();

        if ($digunakan) {
<<<<<<< HEAD
            return redirect()->route('produk.index')
                ->with('error', 'Produk sedang digunakan pada transaksi dan tidak dapat dihapus.');
        }

        $produk->delete();

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
>>>>>>> 49def9d (update projek)
=======
            return redirect()
                ->route('produk.index')
                ->with('error', 'Produk sedang digunakan pada transaksi dan tidak dapat dihapus.');
        }

        // Hapus foto dari storage
        if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
            Storage::disk('public')->delete($produk->foto);
        }

        $produk->delete();

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
>>>>>>> e5fa7ac (Update fitur baru)
