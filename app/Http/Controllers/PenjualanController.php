<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index(SearchRequest $request)
    {
        $user = Auth::user();
        $keyword = $request->input('search');

        $penjualan = Penjualan::with('user')
            ->when($user->role->name == 'kasir', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('penjualan.index', compact('penjualan'));
    }


    public function create(SearchRequest $request)
    {
        $sale = Penjualan::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'status' => 'OPEN'
            ],
            [
                'total_pembayaran' => 0,
                'metode_pembayaran' => 'CASH'
            ]
        );


        $keyword = $request->input('search');


        $products = Produk::when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })
            ->orderBy('nama')
            ->get();


        $mode = 'create';


        return view('penjualan.pos', compact(
            'sale',
            'products',
            'mode'
        ));
    }


    public function destroy(Penjualan $penjualan)
    {
        $this->authorize('delete', $penjualan);


        if ($penjualan->status !== 'OPEN') {
            return redirect()
                ->route('penjualan.index')
                ->with('error', 'Transaksi sudah selesai tidak bisa dibatalkan');
        }


        DB::transaction(function () use ($penjualan) {

            foreach ($penjualan->itemPenjualan as $item) {
                $item->produk->increment(
                    'stok',
                    $item->kuantitas
                );
            }


            $penjualan->itemPenjualan()->delete();
            $penjualan->delete();

        });


        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil dibatalkan');
    }



    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'payment_method' => 'required|in:CASH,TRANSFER,QRIS'
        ]);


        if ($penjualan->status !== 'OPEN') {
            return back()->with(
                'errors',
                'Transaksi sudah diproses'
            );
        }


        if ($penjualan->itemPenjualan()->count() === 0) {
            return back()->with(
                'errors',
                'Keranjang masih kosong'
            );
        }


        $total = $penjualan
            ->itemPenjualan()
            ->sum('subtotal');


        $penjualan->update([
            'metode_pembayaran' => $request->payment_method,
            'total_pembayaran' => $total,
        ]);



        // Jika QRIS tampilkan halaman QR
        if ($request->payment_method == 'QRIS') {

            return redirect()
                ->route(
                    'penjualan.qris',
                    $penjualan->id
                );
        }



        // CASH dan TRANSFER langsung selesai
        $penjualan->update([
            'status' => $request->status
        ]);

        if ($request->status == 'OPEN') {
            return redirect()
                ->route('penjualan.index')
                ->with('success', 'Transaksi berhasil disimpan sebagai OPEN');
        }

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil diselesaikan');
    }



    public function edit(Penjualan $penjualan)
    {
        $sale = $penjualan;


        if ($sale->status === 'COMPLETED') {

            return redirect()
                ->route('penjualan.index')
                ->with(
                    'errors',
                    'Transaksi sudah selesai dan tidak dapat diedit'
                );
        }


        $sale->load('itemPenjualan');


        $products = Produk::orderBy('nama')->get();


        $mode = 'edit';


        return view('penjualan.pos', compact(
            'sale',
            'products',
            'mode'
        ));
    }



    public function show(Penjualan $penjualan)
    {
        $penjualan->load([
            'user',
            'itemPenjualan.produk'
        ]);


        return view(
            'penjualan.detail',
            compact('penjualan')
        );
    }



    public function cetak($id)
    {
        $penjualan = Penjualan::with([
            'user',
            'itemPenjualan.produk'
        ])
        ->findOrFail($id);


        return view(
            'penjualan.cetak',
            compact('penjualan')
        );
    }



    // =========================
    // QRIS
    // =========================

    public function qris($id)
    {
        $penjualan = Penjualan::with([
            'user',
            'itemPenjualan.produk'
        ])
        ->findOrFail($id);


        return view(
            'penjualan.qris',
            compact('penjualan')
        );
    }



    public function konfirmasiBayar($id)
{
    $penjualan = Penjualan::findOrFail($id);

    $penjualan->update([
        'status' => 'COMPLETED'
    ]);


    return redirect()
        ->route('penjualan.cetak', $penjualan->id)
        ->with('success','Pembayaran QRIS berhasil');
}
}