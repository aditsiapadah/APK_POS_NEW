@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')

<div class="max-w-2xl mx-auto bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-200 dark:border-slate-700 p-8">

    <div class="mb-8">
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">
            Edit Produk
        </h2>
        <p class="text-slate-500 dark:text-slate-400 mt-1">
            Perbarui data produk di bawah ini.
        </p>
    </div>

    @if ($errors->any())
        <div class="mb-6 bg-red-100 dark:bg-red-900 border border-red-300 dark:border-red-700 text-red-700 dark:text-red-200 rounded-xl p-4">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('produk.update', $produk->id) }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-6">

        @csrf
        @method('PUT')

        {{-- Nama Produk --}}
        <div>
            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-200">
                Nama Produk
            </label>

            <input
                type="text"
                name="nama"
                value="{{ old('nama', $produk->nama) }}"
                class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none"
                required>
        </div>

        {{-- Jenis Produk --}}
        <div>
            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-200">
                Jenis Produk
            </label>

            <select
                name="jenis_produk"
                class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none"
                required>

                <option value=""></option>

                <option value="Makanan" {{ old('jenis_produk', $produk->jenis_produk) == 'Makanan' ? 'selected' : '' }}>
                    Makanan
                </option>

                <option value="Minuman" {{ old('jenis_produk', $produk->jenis_produk) == 'Minuman' ? 'selected' : '' }}>
                    Minuman
                </option>

                <option value="Elektronik" {{ old('jenis_produk', $produk->jenis_produk) == 'Elektronik' ? 'selected' : '' }}>
                    Elektronik
                </option>

                <option value="Lainnya" {{ old('jenis_produk', $produk->jenis_produk) == 'Lainnya' ? 'selected' : '' }}>
                    Lainnya
                </option>

            </select>
        </div>

        {{-- Foto --}}
        <div>

            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-200">
                Foto Produk
            </label>

            @if($produk->foto)
                <div class="mb-4">
                    <img
                        src="{{ asset('storage/' . $produk->foto) }}"
                        alt="{{ $produk->nama }}"
                        class="w-28 h-28 rounded-xl object-cover border border-slate-300 dark:border-slate-600 shadow">
                </div>
            @endif

            <input
                type="file"
                name="foto"
                accept="image/*"
                class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-700 dark:text-white px-4 py-3">

            <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                Kosongkan jika tidak ingin mengganti foto.
            </p>

        </div>

        {{-- Harga Beli --}}
        <div>
            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-200">
                Harga Beli (Rp)
            </label>

            <input
                type="number"
                name="harga_beli"
                value="{{ old('harga_beli', $produk->harga_beli) }}"
                min="0"
                class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none"
                required>
        </div>

        {{-- Harga Jual --}}
        <div>
            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-200">
                Harga Jual (Rp)
            </label>

            <input
                type="number"
                name="harga_jual"
                value="{{ old('harga_jual', $produk->harga_jual) }}"
                min="0"
                class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none"
                required>
        </div>

        {{-- Stok --}}
        <div>
            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-200">
                Stok
            </label>

            <input
                type="number"
                name="stok"
                value="{{ old('stok', $produk->stok) }}"
                min="0"
                class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none"
                required>
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end gap-3 pt-4">

            <a href="{{ route('produk.index') }}"
                class="px-5 py-3 rounded-xl bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-white hover:bg-slate-300 dark:hover:bg-slate-600 transition font-semibold">
                Kembali
            </a>

            <button
                type="submit"
                class="px-5 py-3 rounded-xl bg-[#0A2540] hover:bg-[#12395f] text-white font-semibold transition">
                Simpan Perubahan
            </button>

        </div>

    </form>

</div>

@endsection