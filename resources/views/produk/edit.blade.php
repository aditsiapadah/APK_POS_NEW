@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')

<div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-200 dark:border-slate-700 p-8">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">

        <div>
            <h1 class="text-3xl font-bold text-[#0A2540] dark:text-white">
                Edit Produk
            </h1>
        </div>

    </div>

    @if ($errors->any())

        <div class="mb-6 rounded-xl bg-red-100 dark:bg-red-900 border border-red-300 dark:border-red-700 p-4">

            <ul class="list-disc list-inside text-red-700 dark:text-red-200 space-y-1">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form
        action="{{ route('produk.update', $produk->id) }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            {{-- ========================= --}}
            {{-- KOLOM KIRI --}}
            {{-- ========================= --}}

            <div class="space-y-6">

                {{-- Nama Produk --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                        Nama Produk
                    </label>

                    <input
                        type="text"
                        name="nama"
                        value="{{ old('nama', $produk->nama) }}"
                        placeholder="Masukkan nama produk"
                        required
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-4 py-3 text-slate-800 dark:text-white outline-none focus:ring-2 focus:ring-[#0A2540]/20 focus:border-[#0A2540]">

                </div>

                {{-- Jenis Produk --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                        Jenis Produk
                    </label>

                    <select
                        name="jenis_produk"
                        required
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-4 py-3 text-slate-800 dark:text-white outline-none focus:ring-2 focus:ring-[#0A2540]/20 focus:border-[#0A2540]">

                        <option value=""></option>

                        <option value="Makanan"
                            {{ old('jenis_produk', $produk->jenis_produk) == 'Makanan' ? 'selected' : '' }}>
                            🍔 Makanan
                        </option>

                        <option value="Minuman"
                            {{ old('jenis_produk', $produk->jenis_produk) == 'Minuman' ? 'selected' : '' }}>
                            🥤 Minuman
                        </option>

                        <option value="Elektronik"
                            {{ old('jenis_produk', $produk->jenis_produk) == 'Elektronik' ? 'selected' : '' }}>
                            💻 Elektronik
                        </option>

                        <option value="Lainnya"
                            {{ old('jenis_produk', $produk->jenis_produk) == 'Lainnya' ? 'selected' : '' }}>
                            📦 Lainnya
                        </option>

                    </select>

                </div>

                {{-- Distributor --}}

                <div>

                    <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-200">

                        Distributor

                    </label>


                    <select
                        name="distributor_id"

                        class="w-full px-4 py-3 rounded-lg border
                        dark:bg-slate-700
                        dark:border-slate-600
                        dark:text-white
                        focus:ring-2 focus:ring-blue-500">


                        <option value="">
                        </option>



                        @foreach($distributors as $distributor)


                        <option value="{{ $distributor->id }}"

                            {{ old('distributor_id', $produk->distributor_id) == $distributor->id ? 'selected' : '' }}>


                            {{ $distributor->nama_distributor }}


                            @if($distributor->nama_perusahaan)

                                - {{ $distributor->nama_perusahaan }}

                            @endif


                        </option>


                        @endforeach


                    </select>



                    @error('distributor_id')

                    <p class="text-red-500 text-sm mt-1">

                        {{ $message }}

                    </p>

                    @enderror


                </div>

                {{-- FOTO PRODUK --}}
                                <div>

                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                        Foto Produk
                    </label>

                    <div class="flex flex-col items-center">

                        <div
                            class="w-64 h-64 rounded-2xl border-2 border-dashed border-slate-300 dark:border-slate-600 bg-slate-100 dark:bg-slate-700 overflow-hidden shadow-md flex items-center justify-center">

                            <img
                                id="preview-image"
                                src="{{ $produk->foto ? asset('storage/' . $produk->foto) : asset('images/no-image.png') }}"
                                alt="{{ $produk->nama }}"
                                class="w-full h-full object-cover">

                        </div>

                        <input
                            type="file"
                            id="foto"
                            name="foto"
                            accept="image/*"
                            class="mt-5 block w-full text-sm text-slate-700 dark:text-slate-300
                            file:mr-4
                            file:px-5
                            file:py-3
                            file:rounded-xl
                            file:border-0
                            file:bg-[#0A2540]
                            file:text-white
                            hover:file:bg-[#12395f]
                            cursor-pointer">

                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">
                            Kosongkan jika tidak ingin mengganti foto.
                        </p>

                        @error('foto')
                            <p class="text-sm text-red-500 mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </div>

            {{-- ========================= --}}
            {{-- KOLOM KANAN --}}
            {{-- ========================= --}}

            <div class="space-y-6">

                {{-- Harga Beli --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                        Harga Beli (Rp)
                    </label>

                    <input
                        type="number"
                        name="harga_beli"
                        value="{{ old('harga_beli', $produk->harga_beli) }}"
                        min="0"
                        required
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-4 py-3 text-slate-800 dark:text-white outline-none focus:ring-2 focus:ring-[#0A2540]/20 focus:border-[#0A2540]">

                </div>

                {{-- Harga Jual --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                        Harga Jual (Rp)
                    </label>

                    <input
                        type="number"
                        name="harga_jual"
                        value="{{ old('harga_jual', $produk->harga_jual) }}"
                        min="0"
                        required
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-4 py-3 text-slate-800 dark:text-white outline-none focus:ring-2 focus:ring-[#0A2540]/20 focus:border-[#0A2540]">

                </div>

                {{-- Stok --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                        Stok
                    </label>

                    <input
                        type="number"
                        name="stok"
                        value="{{ old('stok', $produk->stok) }}"
                        min="0"
                        required
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-4 py-3 text-slate-800 dark:text-white outline-none focus:ring-2 focus:ring-[#0A2540]/20 focus:border-[#0A2540]">

                </div>
                        </div>

        </div>

        {{-- Tombol --}}
        <div class="flex gap-3 mt-8 border-t border-slate-200 dark:border-slate-700 pt-6">

            <a href="{{ route('produk.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-xl transition font-medium">
                <i class="fa-solid fa-arrow-left mr-2"></i>
                Kembali
            </a>

            <button
                type="submit"
                class="bg-[#0A2540] hover:bg-[#12395f] text-white px-5 py-3 rounded-xl transition font-medium">
                <i class="fa-solid fa-save mr-2"></i>
                Simpan Perubahan
            </button>

        </div>

    </form>

</div>

<script>

const foto = document.getElementById('foto');
const preview = document.getElementById('preview-image');

foto.addEventListener('change', function(e) {

    const file = e.target.files[0];

    if (!file) {

        preview.src = "{{ $produk->foto ? asset('storage/'.$produk->foto) : asset('images/no-image.png') }}";
        return;

    }

    if (!file.type.startsWith('image/')) {

        alert('File harus berupa gambar!');

        foto.value = '';

        preview.src = "{{ $produk->foto ? asset('storage/'.$produk->foto) : asset('images/no-image.png') }}";

        return;

    }

    const reader = new FileReader();

    reader.onload = function(event) {

        preview.src = event.target.result;

    }

    reader.readAsDataURL(file);

});

</script>

@endsection