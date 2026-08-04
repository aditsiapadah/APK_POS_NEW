@extends('layouts.app')

@section('title', 'Tambah Distributor')

@section('content')

<div class="mb-8">
    <h1 class="text-3xl font-bold text-[#0A2540] dark:text-white">
        Tambah Distributor
    </h1>
    <p class="text-gray-500 dark:text-gray-400 mt-2">
        Tambahkan data distributor baru.
    </p>
</div>

<div class="bg-white dark:bg-slate-800 rounded-xl shadow p-8">
    <form action="{{ route('distributor.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Nama Distributor --}}
            <div>
                <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-200">
                    Nama Distributor
                </label>
                <input 
                    type="text"
                    name="nama_distributor"
                    value="{{ old('nama_distributor') }}"
                    placeholder="Masukkan nama distributor"
                    class="w-full px-4 py-3 rounded-lg border
                    dark:bg-slate-700
                    dark:border-slate-600
                    dark:text-white
                    focus:ring-2 focus:ring-blue-500">
                @error('nama_distributor')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
                @enderror
            </div>

            {{-- Nama Perusahaan --}}
            <div>
                <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-200">
                    Nama Perusahaan
                </label>
                <input 
                    type="text"
                    name="nama_perusahaan"
                    value="{{ old('nama_perusahaan') }}"
                    placeholder="Masukkan nama perusahaan"
                    class="w-full px-4 py-3 rounded-lg border
                    dark:bg-slate-700
                    dark:border-slate-600
                    dark:text-white
                    focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- Telepon --}}
            <div>
                <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-200">
                    Nomor Telepon
                </label>
                <input 
                    type="text"
                    name="telepon"
                    value="{{ old('telepon') }}"
                    placeholder="08xxxxxxxxxx"
                    class="w-full px-4 py-3 rounded-lg border
                    dark:bg-slate-700
                    dark:border-slate-600
                    dark:text-white
                    focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- Email --}}
            <div>
                <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-200">
                    Email
                </label>
                <input 
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="email@gmail.com"
                    class="w-full px-4 py-3 rounded-lg border
                    dark:bg-slate-700
                    dark:border-slate-600
                    dark:text-white
                    focus:ring-2 focus:ring-blue-500">
                @error('email')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
                @enderror
            </div>

            {{-- Alamat --}}
            <div class="md:col-span-2">
                <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-200">
                    Alamat
                </label>
                <textarea
                    name="alamat"
                    rows="4"
                    placeholder="Masukkan alamat distributor"
                    class="w-full px-4 py-3 rounded-lg border
                    dark:bg-slate-700
                    dark:border-slate-600
                    dark:text-white
                    focus:ring-2 focus:ring-blue-500">{{ old('alamat') }}</textarea>
            </div>
        </div>

        {{-- BUTTON --}}
        <div class="flex justify-end gap-3 mt-8">
            <a href="{{ route('distributor.index') }}"
                class="px-5 py-3 rounded-lg bg-gray-500 text-white hover:bg-gray-600 transition">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali
            </a>
            <button
                type="submit"
                class="px-5 py-3 rounded-lg bg-[#1E3A8A]
                text-white hover:bg-blue-800 transition">
                <i class="fa-solid fa-save"></i>
                Simpan
            </button>
        </div>
    </form>
</div>

@endsection