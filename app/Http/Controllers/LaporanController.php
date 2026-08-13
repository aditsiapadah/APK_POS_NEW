<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Jenis laporan
        $jenis = $request->input('jenis', 'harian');

        // Tanggal untuk harian / mingguan
        $tanggal = $request->input(
            'tanggal',
            now()->format('Y-m-d')
        );

        // Bulan untuk bulanan
        $bulan = $request->input(
            'bulan',
            now()->format('Y-m')
        );

        /*
        |--------------------------------------------------------------------------
        | Menentukan periode laporan
        |--------------------------------------------------------------------------
        */

        if ($jenis === 'mingguan') {

            $tanggalCarbon = Carbon::parse($tanggal);

            $tanggalAwal = $tanggalCarbon
                ->copy()
                ->startOfWeek(Carbon::MONDAY);

            $tanggalAkhir = $tanggalCarbon
                ->copy()
                ->endOfWeek(Carbon::SUNDAY);

        } elseif ($jenis === 'bulanan') {

            $bulanCarbon = Carbon::createFromFormat(
                'Y-m',
                $bulan
            );

            $tanggalAwal = $bulanCarbon
                ->copy()
                ->startOfMonth();

            $tanggalAkhir = $bulanCarbon
                ->copy()
                ->endOfMonth();

        } else {

            // Harian
            $tanggalCarbon = Carbon::parse($tanggal);

            $tanggalAwal = $tanggalCarbon
                ->copy()
                ->startOfDay();

            $tanggalAkhir = $tanggalCarbon
                ->copy()
                ->endOfDay();
        }

        /*
        |--------------------------------------------------------------------------
        | Query transaksi
        |--------------------------------------------------------------------------
        */

        $query = Penjualan::with([
            'user',
            'itemPenjualan.produk'
        ])
        ->where('status', 'COMPLETED')
        ->whereBetween('created_at', [
            $tanggalAwal,
            $tanggalAkhir
        ]);

        /*
        |--------------------------------------------------------------------------
        | Kasir hanya melihat laporan miliknya
        |--------------------------------------------------------------------------
        */

        if (
            $user->role &&
            strtolower($user->role->name) === 'kasir'
        ) {
            $query->where('user_id', $user->id);
        }

        $penjualan = $query
            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Statistik utama
        |--------------------------------------------------------------------------
        */

        $totalTransaksi = $penjualan->count();

        $totalPendapatan = $penjualan->sum(
            'total_pembayaran'
        );

        $totalProdukTerjual = $penjualan->sum(function ($penjualan) {
            return $penjualan->itemPenjualan->sum(
                'kuantitas'
            );
        });

        /*
        |--------------------------------------------------------------------------
        | Metode pembayaran
        |--------------------------------------------------------------------------
        */

        $totalCash = $penjualan
            ->where('metode_pembayaran', 'CASH')
            ->sum('total_pembayaran');

        $totalTransfer = $penjualan
            ->where('metode_pembayaran', 'TRANSFER')
            ->sum('total_pembayaran');

        $totalQris = $penjualan
            ->where('metode_pembayaran', 'QRIS')
            ->sum('total_pembayaran');

        $jumlahCash = $penjualan
            ->where('metode_pembayaran', 'CASH')
            ->count();

        $jumlahTransfer = $penjualan
            ->where('metode_pembayaran', 'TRANSFER')
            ->count();

        $jumlahQris = $penjualan
            ->where('metode_pembayaran', 'QRIS')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Produk Terlaris
        |--------------------------------------------------------------------------
        */

        $produkTerlaris = [];

        foreach ($penjualan as $transaksi) {

            foreach ($transaksi->itemPenjualan as $item) {

                if (!$item->produk) {
                    continue;
                }

                $produkId = $item->produk->id;

                if (!isset($produkTerlaris[$produkId])) {

                    $produkTerlaris[$produkId] = [
                        'nama' => $item->produk->nama,
                        'jumlah' => 0,
                    ];
                }

                $produkTerlaris[$produkId]['jumlah']
                    += $item->kuantitas;
            }
        }

        $produkTerlaris = collect($produkTerlaris)
            ->sortByDesc('jumlah')
            ->take(5)
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Nama periode
        |--------------------------------------------------------------------------
        */

        if ($jenis === 'harian') {

            $periode = $tanggalCarbon->translatedFormat(
                'd F Y'
            );

        } elseif ($jenis === 'mingguan') {

            $periode =
                $tanggalAwal->translatedFormat('d F Y')
                . ' - ' .
                $tanggalAkhir->translatedFormat('d F Y');

        } else {

            $periode = $bulanCarbon->translatedFormat(
                'F Y'
            );
        }

        return view('laporan.index', compact(
            'jenis',
            'tanggal',
            'bulan',
            'periode',

            'totalTransaksi',
            'totalPendapatan',
            'totalProdukTerjual',

            'totalCash',
            'totalTransfer',
            'totalQris',

            'jumlahCash',
            'jumlahTransfer',
            'jumlahQris',

            'produkTerlaris'
        ));
    }
}