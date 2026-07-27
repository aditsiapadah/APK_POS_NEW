@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-xl shadow-sm border border-slate-100 p-6">
    <h2 class="text-xl font-bold text-slate-800 mb-6">Tambah Produk Baru</h2>

    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Nama Produk</label>
            <input type="text" name="nama_produk" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-blue-500">
        </div>

        <div>
    <label class="block text-sm font-medium text-slate-700 mb-1">
        Jenis Produk
    </label>

    <select 
        name="jenis_produk" 
        required
        class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-blue-500">
        
        <option value=""></option>
        <option value="Makanan">Makanan</option>
        <option value="Minuman">Minuman</option>
        <option value="Elektronik">Elektronik</option>
        <option value="Lainnya">Lainnya</option>

    </select>
</div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Foto Produk</label>
            <input type="file" name="foto" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none bg-white">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Harga Beli (Rp)</label>
            <input type="number" name="harga_beli" required min="0" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-blue-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Harga Jual (Rp)</label>
            <input
                type="number"
                name="harga_jual"
                required
                min="0"
                class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-blue-500">
        </div>

        

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Stok</label>
            <input type="number" name="stok" required min="0" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-blue-500">
        </div>

        <div class="flex justify-end space-x-3 pt-4">
            <a href="{{ route('produk.index') }}" class="bg-slate-100 text-slate-600 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-slate-200 transition">Batal</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition">Simpan</button>
        </div>
    </form>
</div>
@endsection