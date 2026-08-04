<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use Illuminate\Http\Request;

class DistributorController extends Controller
{
    /**
     * Menampilkan daftar distributor.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $distributors = Distributor::when($search, function ($query) use ($search) {
                $query->where('nama_distributor', 'like', '%' . $search . '%')
                      ->orWhere('nama_perusahaan', 'like', '%' . $search . '%')
                      ->orWhere('telepon', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('distributor.index', compact('distributors'));
    }

    /**
     * Menampilkan form tambah distributor.
     */
    public function create()
    {
        return view('distributor.create');
    }

    /**
     * Menyimpan distributor baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_distributor' => 'required|string|max:255',
            'nama_perusahaan'  => 'nullable|string|max:255',
            'telepon'          => 'nullable|string|max:20',
            'email'            => 'nullable|email|max:255',
            'alamat'           => 'nullable|string',
        ]);

        Distributor::create([
            'nama_distributor' => $request->nama_distributor,
            'nama_perusahaan'  => $request->nama_perusahaan,
            'telepon'          => $request->telepon,
            'email'            => $request->email,
            'alamat'           => $request->alamat,
        ]);

        return redirect()
            ->route('distributor.index')
            ->with('success', 'Distributor berhasil ditambahkan.');
    }

    // Method show() tidak digunakan

    /**
     * Menampilkan form edit distributor.
     */
    public function edit(Distributor $distributor)
    {
        return view('distributor.edit', compact('distributor'));
    }

    /**
     * Memperbarui data distributor.
     */
    public function update(Request $request, Distributor $distributor)
    {
        $request->validate([
            'nama_distributor' => 'required|string|max:255',
            'nama_perusahaan'  => 'nullable|string|max:255',
            'telepon'          => 'nullable|string|max:20',
            'email'            => 'nullable|email|max:255',
            'alamat'           => 'nullable|string',
        ]);

        $distributor->update([
            'nama_distributor' => $request->nama_distributor,
            'nama_perusahaan'  => $request->nama_perusahaan,
            'telepon'          => $request->telepon,
            'email'            => $request->email,
            'alamat'           => $request->alamat,
        ]);

        return redirect()
            ->route('distributor.index')
            ->with('success', 'Distributor berhasil diperbarui.');
    }

    /**
     * Menghapus distributor.
     */
    public function destroy(Distributor $distributor)
    {
        // Cek apakah distributor masih digunakan oleh produk
        if ($distributor->produk()->exists()) {
            return redirect()
                ->route('distributor.index')
                ->with('error', 'Distributor tidak dapat dihapus karena masih digunakan oleh produk.');
        }

        $distributor->delete();

        return redirect()
            ->route('distributor.index')
            ->with('success', 'Distributor berhasil dihapus.');
    }
}