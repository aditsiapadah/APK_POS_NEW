<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{

    public function index()
    {
        $produk = Produk::paginate(10);

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
            'nama' => 'required',
            'jenis_produk' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);


        $produk->update([
            'nama' => $request->nama,
            'jenis_produk' => $request->jenis_produk,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
        ]);


        return redirect()
            ->route('produk.index')
            ->with('success','Produk berhasil diperbarui');
    }

}