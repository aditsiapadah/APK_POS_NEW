@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold text-[#0A2540]">Ringkasan Hari Ini</h1>
    <p class="text-slate-600 mt-2">{{ $tanggalHariIni->translatedFormat('l, d F Y') }}</p>
</div>

{{-- KARTU STATISTIK: HANYA TAMPIL UNTUK ADMIN --}}
@if(auth()->user()->role->name == 'Admin')
<!-- Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <div class="bg-white rounded-3xl p-6 shadow-xl card-hover border border-slate-100 flex items-center justify-between">
        <div>
            <p class="text-slate-500 text-xs font-medium">Total Penjualan Hari Ini</p>
            <p class="text-2xl font-bold text-[#0A2540] mt-2">Rp {{ number_format($ringkasan->total_pendapatan ?? 0, 0, ',', '.') }}</p>
        </div>
        <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center text-4xl flex-shrink-0 ml-4">💰</div>
    </div>

    <div class="bg-white rounded-3xl p-6 shadow-xl card-hover border border-slate-100 flex items-center justify-between">
        <div>
            <p class="text-slate-500 text-xs font-medium">Jumlah Transaksi</p>
            <p class="text-3xl font-bold text-[#0A2540] mt-2">{{ $ringkasan->total_transaksi ?? 0 }}</p>
        </div>
        <div class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center text-4xl flex-shrink-0 ml-4">📊</div>
    </div>

    <div class="bg-white rounded-3xl p-6 shadow-xl card-hover border border-slate-100 flex items-center justify-between">
        <div>
            <p class="text-slate-500 text-xs font-medium">Total Pembayaran Tunai</p>
            <p class="text-2xl font-bold text-[#0A2540] mt-2">Rp {{ number_format($ringkasan->total_cash ?? 0, 0, ',', '.') }}</p>
        </div>
        <div class="w-16 h-16 bg-amber-100 rounded-2xl flex items-center justify-center text-4xl flex-shrink-0 ml-4">💵</div>
    </div>

    <div class="bg-white rounded-3xl p-6 shadow-xl card-hover border border-slate-100 flex items-center justify-between">
        <div>
            <p class="text-slate-500 text-xs font-medium">Total Pembayaran Non-Tunai</p>
            <p class="text-2xl font-bold text-[#0A2540] mt-2">Rp {{ number_format($ringkasan->total_non_tunai ?? 0, 0, ',', '.') }}</p>
        </div>
        <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center text-4xl flex-shrink-0 ml-4">💳</div>
    </div>
</div>
@endif

<!-- Critical Inventory + Best Seller dengan Scroll -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">

    <!-- Stok Rendah -->
    <div class="bg-white rounded-3xl shadow-xl p-8">
        <h3 class="text-xl font-semibold text-[#0A2540] mb-6 flex items-center gap-3">
            <span class="text-orange-500">⚠️</span> Daftar Produk Stok Rendah
        </h3>
        <div class="overflow-x-auto border border-slate-100 rounded-2xl">
            <table class="w-full min-w-[500px]">
                <thead>
                    <tr class="border-b border-slate-200">
                        <th class="text-left py-4 px-6 text-slate-500 font-medium">#</th>
                        <th class="text-left py-4 px-6 text-slate-500 font-medium">Nama Produk</th>
                        <th class="text-center py-4 px-6 text-slate-500 font-medium">Stok</th>
                    </tr>
                </thead>
                <tbody class="text-slate-700 divide-y">
                    @forelse($produkStokRendah as $index => $produk)
                    <tr>
                        <td class="py-4 px-6">{{ $produkStokRendah->firstItem() + $index }}</td>
                        <td class="py-4 px-6">{{ $produk->nama }}</td>
                        <td class="text-center py-4 px-6 font-semibold text-orange-600">{{ $produk->stok }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-8 text-slate-400">Tidak ada produk stok rendah</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($produkStokRendah->hasPages())
        <div class="flex justify-between items-center mt-6">
            <div class="text-sm text-slate-500">
                Menampilkan
                {{ $produkStokRendah->firstItem() }}
                -
                {{ $produkStokRendah->lastItem() }}
                dari
                {{ $produkStokRendah->total() }}
                produk
            </div>
            <div>
                {{ $produkStokRendah->links('pagination::tailwind') }}
            </div>
        </div>
        @endif
    </div>

    <!-- Stok Habis -->
    <div class="bg-white rounded-3xl shadow-xl p-8">
        <h3 class="text-xl font-semibold text-[#0A2540] mb-6 flex items-center gap-3">
            <span class="text-red-500">⛔</span> Daftar Produk Habis
        </h3>
        <div class="overflow-x-auto border border-slate-100 rounded-2xl">
            <table class="w-full min-w-[500px]">
                <thead>
                    <tr class="border-b border-slate-200">
                        <th class="text-left py-4 px-6 text-slate-500 font-medium">#</th>
                        <th class="text-left py-4 px-6 text-slate-500 font-medium">Nama Produk</th>
                        <th class="text-center py-4 px-6 text-slate-500 font-medium">Stok</th>
                    </tr>
                </thead>
                <tbody class="text-slate-700 divide-y">
                    @forelse($produkStokHabis as $index => $produk)
                    <tr>
                        <td class="py-4 px-6">{{ $index + 1 }}</td>
                        <td class="py-4 px-6">{{ $produk->nama }}</td>
                        <td class="text-center py-4 px-6 font-semibold text-red-600">{{ $produk->stok }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-8 text-slate-400">Tidak ada produk habis stok</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Best Seller -->
<div class="bg-white rounded-3xl shadow-xl p-8">
    <h3 class="text-xl font-semibold text-[#0A2540] mb-6 flex items-center gap-3">
        🏆 Best Seller Products Hari Ini
    </h3>
    <div class="overflow-x-auto border border-slate-100 rounded-2xl">
        <table class="w-full min-w-[600px]">
            <thead>
                <tr class="border-b border-slate-200">
                    <th class="text-left py-4 px-6 text-slate-500 font-medium">Nama Produk</th>
                    <th class="text-center py-4 px-6 text-slate-500 font-medium">Stok Saat Ini</th>
                    <th class="text-center py-4 px-6 text-slate-500 font-medium">Unit Terjual</th>
                </tr>
            </thead>
            <tbody class="text-slate-700 divide-y">
                @forelse($produkTerlaris as $produk)
                <tr>
                    <td class="py-4 px-6 font-medium">{{ $produk->nama }}</td>
                    <td class="text-center py-4 px-6">{{ $produk->stok }}</td>
                    <td class="text-center py-4 px-6 font-semibold text-emerald-600">{{ $produk->total_terjual ?? 0 }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-8 text-slate-400">Belum ada penjualan hari ini</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection