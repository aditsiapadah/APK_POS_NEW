@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')

<div class="max-w-xl mx-auto bg-white rounded-xl shadow-sm border border-slate-100 p-6">

    <h2 class="text-xl font-bold text-slate-800 mb-6">
        Edit Data Produk
    </h2>


    <form action="{{ route('produk.update', $produk->id) }}" 
        method="POST" 
        enctype="multipart/form-data" 
        class="space-y-4">

        @csrf
        @method('PUT')


        {{-- Nama Produk --}}
        <div>

            <label class="block text-sm font-medium text-slate-700 mb-1">
                Nama Produk
            </label>

            <input 
                type="text"
                name="nama"
                value="{{ old('nama', $produk->nama) }}"
                required
                class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-blue-500">

        </div>



        {{-- Jenis Produk --}}
        <div>

            <label class="block text-sm font-medium text-slate-700 mb-1">
                Jenis Produk
            </label>


            <select 
                name="jenis_produk"
                required
                class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-blue-500">


                <option value="">
                    
                </option>


                <option value="Makanan"
                    {{ $produk->jenis_produk == 'Makanan' ? 'selected' : '' }}>
                    Makanan
                </option>


                <option value="Minuman"
                    {{ $produk->jenis_produk == 'Minuman' ? 'selected' : '' }}>
                    Minuman
                </option>


                <option value="Elektronik"
                    {{ $produk->jenis_produk == 'Elektronik' ? 'selected' : '' }}>
                    Elektronik
                </option>

                <option value="Lainnya"
                    {{ $produk->jenis_produk == 'Lainnya' ? 'selected' : '' }}>
                    Lainnya
                </option>


            </select>

        </div>





        {{-- Foto Produk --}}
        <div>

            <label class="block text-sm font-medium text-slate-700 mb-1">
                Foto Produk
                <span class="text-xs text-slate-400">
                    (Kosongkan jika tidak diganti)
                </span>
            </label>


            @if($produk->foto)

            <img 
                src="{{ asset('storage/'.$produk->foto) }}"
                class="w-24 h-24 rounded-lg object-cover border mb-3">


            @endif



            <input 
                type="file"
                name="foto"
                class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm bg-white">

        </div>





        {{-- Harga Beli --}}
        <div>

            <label class="block text-sm font-medium text-slate-700 mb-1">
                Harga Beli (Rp)
            </label>


            <input 
                type="number"
                name="harga_beli"
                value="{{ old('harga_beli',$produk->harga_beli) }}"
                required
                min="0"
                class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-blue-500">

        </div>





        {{-- Harga Jual --}}
        <div>

            <label class="block text-sm font-medium text-slate-700 mb-1">
                Harga Jual (Rp)
            </label>


            <input 
                type="number"
                name="harga_jual"
                value="{{ old('harga_jual',$produk->harga_jual) }}"
                required
                min="0"
                class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-blue-500">

        </div>





        {{-- Stok --}}
        <div>

            <label class="block text-sm font-medium text-slate-700 mb-1">
                Stok
            </label>


            <input 
                type="number"
                name="stok"
                value="{{ old('stok',$produk->stok) }}"
                required
                min="0"
                class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-blue-500">

        </div>






        {{-- Tombol --}}
        <div class="flex justify-end space-x-3 pt-4">


            <a href="{{ route('produk.index') }}"
                class="bg-slate-100 text-slate-600 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-slate-200">

                Batal

            </a>



            <button 
                type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700">

                Perbarui

            </button>


        </div>


    </form>


</div>

@endsection