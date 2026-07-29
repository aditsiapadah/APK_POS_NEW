<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;

class RiwayatTransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Penjualan::with('user')
            ->where('status', 'COMPLETED');

        // Search by ID atau Nama Kasir
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', '%' . $search . '%')
                ->orWhereHas('user', function ($user) use ($search) {
                $user->where('name', 'like', '%' . $search . '%');
                });
            });
        }

        // Filter tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $transaksi = $query
            ->latest()
            ->paginate(10)
            ->withQueryString(); // supaya search & tanggal tetap terbawa di pagination

        return view('riwayat.index', compact('transaksi'));
    }

    public function show($id)
    {
        $transaksi = Penjualan::with([
            'user',
            'items.produk'
        ])->findOrFail($id);

        return view('riwayat.show', compact('transaksi'));
    }
}