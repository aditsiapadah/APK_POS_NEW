@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

<div class="max-w-xl mx-auto bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 p-6">

    <h2 class="text-xl font-bold text-slate-800 dark:text-white mb-6">
        Tambah Produk Baru
    </h2>

    <form action="{{ route('produk.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-4">

        @csrf

        {{-- Nama Produk --}}
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                Nama Produk
            </label>

            <input
                type="text"
                name="nama"
                value="{{ old('nama') }}"
                required
                class="w-full border border-slate-200 dark:border-slate-600 rounded-lg px-3 py-2 text-sm bg-white dark:bg-slate-700 text-slate-800 dark:text-white outline-none focus:border-blue-500">
        </div>

        {{-- Jenis Produk --}}
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                Jenis Produk
            </label>

            <select
                name="jenis_produk"
                required
                class="w-full border border-slate-200 dark:border-slate-600 rounded-lg px-3 py-2 text-sm bg-white dark:bg-slate-700 text-slate-800 dark:text-white outline-none focus:border-blue-500">

                <option value=""></option>
                <option value="Makanan">Makanan</option>
                <option value="Minuman">Minuman</option>
                <option value="Elektronik">Elektronik</option>
                <option value="Lainnya">Lainnya</option>

            </select>
        </div>

        {{-- Foto Produk --}}
        <div>

            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                Foto Produk
            </label>

            <input
                type="file"
                name="foto"
                id="foto"
                accept="image/*"
                class="w-full border border-slate-200 dark:border-slate-600 rounded-lg px-3 py-2 text-sm bg-white dark:bg-slate-700 text-slate-800 dark:text-white">

            {{-- Preview --}}
            <div class="mt-4 flex justify-center">

                <img
                    id="preview-image"
                    src="https://placehold.co/250x250?text=Preview+Foto"
                    alt="Preview Foto"
                    class="w-40 h-40 rounded-xl object-cover border border-slate-300 dark:border-slate-600 shadow">

            </div>

        </div>

        {{-- Harga Beli --}}
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                Harga Beli (Rp)
            </label>

            <input
                type="number"
                name="harga_beli"
                value="{{ old('harga_beli') }}"
                required
                min="0"
                class="w-full border border-slate-200 dark:border-slate-600 rounded-lg px-3 py-2 text-sm bg-white dark:bg-slate-700 text-slate-800 dark:text-white outline-none focus:border-blue-500">
        </div>

        {{-- Harga Jual --}}
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                Harga Jual (Rp)
            </label>

            <input
                type="number"
                name="harga_jual"
                value="{{ old('harga_jual') }}"
                required
                min="0"
                class="w-full border border-slate-200 dark:border-slate-600 rounded-lg px-3 py-2 text-sm bg-white dark:bg-slate-700 text-slate-800 dark:text-white outline-none focus:border-blue-500">
        </div>

        {{-- Stok --}}
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                Stok
            </label>

            <input
                type="number"
                name="stok"
                value="{{ old('stok') }}"
                required
                min="0"
                class="w-full border border-slate-200 dark:border-slate-600 rounded-lg px-3 py-2 text-sm bg-white dark:bg-slate-700 text-slate-800 dark:text-white outline-none focus:border-blue-500">
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end gap-3 pt-4">

            <a href="{{ route('produk.index') }}"
                class="bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-slate-200 dark:hover:bg-slate-600 transition">
                Batal
            </a>

            <button
                type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition">
                Simpan
            </button>

        </div>

    </form>

</div>

<script>
document.getElementById('foto').addEventListener('change', function(event) {

    const file = event.target.files[0];

    if (file) {

        const reader = new FileReader();

        reader.onload = function(e) {

            document.getElementById('preview-image').src = e.target.result;

        }

        reader.readAsDataURL(file);

    }

});
</script>

@endsection