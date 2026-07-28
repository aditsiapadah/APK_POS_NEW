@extends('layouts.app')

@section('title', 'Edit Pengaturan')

@section('content')

<div class="space-y-6">

    {{-- Judul --}}
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold text-[#0A2540] dark:text-white">
            Edit Informasi Toko
        </h1>

        <a href="{{ route('pengaturan.index') }}"
           class="bg-slate-600 hover:bg-slate-700 text-white px-5 py-2.5 rounded-xl
           font-medium transition flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    {{-- Alert --}}
    @if($errors->any())
    <div class="mb-5 bg-red-100 dark:bg-red-900 border border-red-300 dark:border-red-700
            text-red-700 dark:text-red-200 px-5 py-3 rounded-xl">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Form --}}
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg p-6 md:p-8">

        <form action="{{ route('pengaturan.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Nama Toko --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Nama Toko
                    </label>
                    <input type="text" name="nama_toko" value="{{ old('nama_toko', $setting->nama_toko) }}"
                        class="w-full border border-gray-300 dark:border-slate-600
                        bg-white dark:bg-slate-700 text-gray-800 dark:text-white
                        rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#0A2540] outline-none"
                        required>
                </div>

                {{-- Alamat --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Alamat
                    </label>
                    <textarea name="alamat" rows="3"
                        class="w-full border border-gray-300 dark:border-slate-600
                        bg-white dark:bg-slate-700 text-gray-800 dark:text-white
                        rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#0A2540] outline-none">{{ old('alamat', $setting->alamat) }}</textarea>
                </div>

                {{-- Telepon --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Telepon / WhatsApp
                    </label>
                    <input type="text" name="telepon" value="{{ old('telepon', $setting->telepon) }}"
                        class="w-full border border-gray-300 dark:border-slate-600
                        bg-white dark:bg-slate-700 text-gray-800 dark:text-white
                        rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#0A2540] outline-none">
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Email
                    </label>
                    <input type="email" name="email" value="{{ old('email', $setting->email) }}"
                        class="w-full border border-gray-300 dark:border-slate-600
                        bg-white dark:bg-slate-700 text-gray-800 dark:text-white
                        rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#0A2540] outline-none">
                </div>

                {{-- Logo --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Logo Toko
                    </label>

                    @if($setting->logo)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $setting->logo) }}"
                             alt="Logo"
                             class="w-24 h-24 object-cover rounded-full border">
                    </div>
                    @endif

                    <input type="file" name="logo" accept="image/*"
                        class="w-full border border-gray-300 dark:border-slate-600
                        bg-white dark:bg-slate-700 text-gray-800 dark:text-white
                        rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#0A2540] outline-none">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, WEBP. Maksimal 2MB. Kosongkan jika tidak ingin mengubah logo.</p>
                </div>

            </div>

            <div class="mt-8 flex justify-end gap-3">
                <a href="{{ route('pengaturan.index') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-xl font-semibold transition">
                    Batal
                </a>

                <button type="submit"
                    class="bg-[#0A2540] hover:bg-[#12395f] text-white px-8 py-3 rounded-xl
                    font-semibold transition shadow-lg">
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>

</div>

{{-- Pengaturan Tampilan --}}
<div class="mt-10">

    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg p-6 md:p-8">

        <h2 class="text-2xl font-bold text-[#0A2540] dark:text-white mb-6">
            Pengaturan Tampilan
        </h2>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">


            {{-- Bahasa --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Bahasa
                </label>

                <select name="bahasa"
                    class="w-full border border-gray-300 dark:border-slate-600
                    bg-white dark:bg-slate-700 text-gray-800 dark:text-white
                    rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#0A2540] outline-none">

                    <option value="id"
                        {{ old('bahasa', $setting->bahasa) == 'id' ? 'selected' : '' }}>
                        Indonesia
                    </option>

                    <option value="en"
                        {{ old('bahasa', $setting->bahasa) == 'en' ? 'selected' : '' }}>
                        English
                    </option>

                </select>
            </div>



            {{-- Mata Uang --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Mata Uang
                </label>

                <select name="mata_uang"
                    class="w-full border border-gray-300 dark:border-slate-600
                    bg-white dark:bg-slate-700 text-gray-800 dark:text-white
                    rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#0A2540] outline-none">

                    <option value="IDR"
                        {{ old('mata_uang', $setting->mata_uang) == 'IDR' ? 'selected' : '' }}>
                        IDR (Rp)
                    </option>

                    <option value="USD"
                        {{ old('mata_uang', $setting->mata_uang) == 'USD' ? 'selected' : '' }}>
                        USD ($)
                    </option>

                </select>
            </div>



            {{-- Data per Halaman --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Data per Halaman
                </label>

                <select name="per_page"
                    class="w-full border border-gray-300 dark:border-slate-600
                    bg-white dark:bg-slate-700 text-gray-800 dark:text-white
                    rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#0A2540] outline-none">


                    @foreach([5,10,15,20,25,50] as $num)

                    <option value="{{ $num }}"
                        {{ old('per_page', $setting->per_page) == $num ? 'selected' : '' }}>
                        {{ $num }} data
                    </option>

                    @endforeach


                </select>

            </div>


        </div>


        {{-- Tombol --}}
<div class="mt-8 flex justify-end gap-3">

    <a href="{{ route('pengaturan.index') }}"
       class="bg-gray-200 hover:bg-gray-300 
       text-gray-700 px-6 py-3 rounded-xl
       font-semibold transition">

        Batal

    </a>


    <button type="submit"
        class="bg-[#0A2540] hover:bg-[#12395f]
        text-white px-8 py-3 rounded-xl
        font-semibold transition shadow-lg">

        Simpan Tampilan

    </button>

</div>


    </div>

</div>

@endsection