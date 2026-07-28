@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-2">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-[#0A2540] dark:text-white">
                Detail Transaksi
            </h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">
                ID #{{ $transaksi->id }}
            </p>
        </div>

        <a href="{{ route('riwayat.index') }}"
            class="inline-flex items-center gap-2 bg-slate-600 hover:bg-slate-700
            text-white px-5 py-2.5 rounded-xl font-medium transition shadow">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    {{-- Info Transaksi --}}
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg p-6 md:p-8">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Kasir</p>
                <p class="font-semibold text-gray-900 dark:text-white text-lg">
                    {{ $transaksi->user->name ?? $transaksi->user->nama ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Tanggal</p>
                <p class="font-semibold text-gray-900 dark:text-white text-lg">
                    {{ $transaksi->created_at->format('d-m-Y H:i') }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Metode Pembayaran</p>
                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold mt-1
                    {{ ($transaksi->metode_pembayaran ?? '') == 'CASH'
                        ? 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-200'
                        : 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200' }}">
                    {{ $transaksi->metode_pembayaran ?? '-' }}
                </span>
            </div>

            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Status</p>
                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold mt-1
                    {{ ($transaksi->status ?? 'COMPLETED') == 'COMPLETED'
                        ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900 dark:text-emerald-200'
                        : 'bg-amber-100 text-amber-700 dark:bg-amber-900 dark:text-amber-200' }}">
                    {{ $transaksi->status ?? 'COMPLETED' }}
                </span>
            </div>

        </div>
    </div>

    {{-- Tabel Item --}}
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg overflow-hidden">

        <div class="px-6 md:px-8 py-5 border-b border-gray-200 dark:border-slate-700">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                Daftar Produk
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-slate-700">
                    <tr class="text-left text-gray-500 dark:text-gray-200 text-sm">
                        <th class="px-6 md:px-8 py-4">Produk</th>
                        <th class="px-6 md:px-8 py-4 text-center">Qty</th>
                        <th class="px-6 md:px-8 py-4 text-right">Harga Satuan</th>
                        <th class="px-6 md:px-8 py-4 text-right">Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($transaksi->items as $item)
                    <tr class="border-t border-gray-200 dark:border-slate-700 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                        <td class="px-6 md:px-8 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $item->produk->nama ?? '-' }}
                        </td>
                        <td class="px-6 md:px-8 py-4 text-center text-gray-700 dark:text-gray-200">
                            {{ $item->kuantitas }}
                        </td>
                        <td class="px-6 md:px-8 py-4 text-right text-gray-700 dark:text-gray-200">
                            Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                        </td>
                        <td class="px-6 md:px-8 py-4 text-right font-medium text-gray-900 dark:text-white">
                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-10 text-center text-gray-500 dark:text-gray-400">
                            Tidak ada item
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Total --}}
        <div class="px-6 md:px-8 py-5 border-t border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-700/50 flex justify-end">
            <div class="text-right">
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Total Pembayaran</p>
                <p class="text-2xl font-bold text-[#0A2540] dark:text-white">
                    Rp {{ number_format($transaksi->total_pembayaran, 0, ',', '.') }}
                </p>
            </div>
        </div>
    </div>

</div>

@endsection