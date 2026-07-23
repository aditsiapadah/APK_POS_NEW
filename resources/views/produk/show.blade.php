@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-xl shadow-sm border border-slate-100 p-6">
    <h2 class="text-xl font-bold text-slate-800 mb-6">Detail Produk</h2>

    <div class="space-y-4 text-sm">
        <div>
            <span class="block text-xs font-semibold text-slate-400 uppercase">Nama Produk</span>
            <span class="text-slate-800 font-medium text-base">{{ $produk->nama ?? $produk->nama_produk ?? $produk->name }}</span>
        </div>

        <div>
            <span class="block text-xs font-semibold text-slate-400 uppercase">Penginput (User)</span>
            <span class="text-slate-700">{{ $produk->user->name ?? '-' }}</span>
        </div>

        <div>
            <span class="block text-xs font-semibold text-slate-400 uppercase">Foto</span>
            @if($produk->foto)
                <span class="text-slate-700">{{ $produk->foto }}</span>
            @else
                <span class="text-slate-400 italic">Tidak ada foto</span>
            @endif
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <span class="block text-xs font-semibold text-slate-400 uppercase">Harga Beli</span>
                <span class="text-slate-700 font-semibold">Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}</span>
            </div>
            <div>
                <span class="block text-xs font-semibold text-slate-400 uppercase">Harga Jual</span>
                <span class="text-slate-700 font-semibold">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
            </div>
        </div>

        <div>
            <span class="block text-xs font-semibold text-slate-400 uppercase">Stok Tersedia</span>
            <span class="text-slate-700 font-semibold">{{ $produk->stok }} Unit</span>
        </div>
    </div>

    <div class="flex justify-end pt-6 mt-6 border-t border-slate-100">
        <a href="{{ route('produk.index') }}" class="bg-slate-100 text-slate-600 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-slate-200 transition">
            Kembali
        </a>
    </div>
</div>
@endsection