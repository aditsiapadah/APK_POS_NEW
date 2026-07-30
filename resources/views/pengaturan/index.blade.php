@extends('layouts.app')

@section('title', 'Pengaturan')

@section('content')

<div class="space-y-6">

    {{-- Judul + Tombol Edit --}}
    <div class="flex justify-between items-center mb-8">

        <h1 class="text-4xl font-bold text-[#0A2540] dark:text-white">
            Pengaturan
        </h1>

        <a href="{{ route('pengaturan.edit') }}"
           class="bg-[#0A2540] hover:bg-[#12395f] text-white px-6 py-3 rounded-xl
           font-semibold transition shadow-lg flex items-center gap-2">

            <i class="fa-solid fa-pen"></i>
            Edit
        </a>

    </div>
    {{-- Informasi Toko --}}
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg p-6 md:p-8">


        <div class="flex items-center gap-3 mb-8">

            <div class="w-10 h-10 bg-[#0A2540] rounded-xl flex items-center justify-center text-white">
                <i class="fa-solid fa-store"></i>
            </div>

            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                Informasi Toko
            </h2>

        </div>


        <div class="flex flex-col md:flex-row gap-8 items-start">


            {{-- Logo --}}
            <div class="flex-shrink-0">

                @if($setting->logo)

                    <img src="{{ asset('storage/' . $setting->logo) }}"
                         alt="Logo Toko"
                         class="w-32 h-32 rounded-full object-cover border-4 
                         border-gray-100 dark:border-slate-600 shadow">

                @else

                    <div class="w-32 h-32 rounded-full bg-[#0A2540]
                        flex items-center justify-center text-white text-4xl 
                        font-bold shadow">

                        {{ strtoupper(substr($setting->nama_toko ?? 'P', 0, 1)) }}

                    </div>

                @endif

            </div>


            {{-- Data --}}
            <div class="flex-1 space-y-5">


                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Nama Toko
                    </p>

                    <p class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ $setting->nama_toko ?? '-' }}
                    </p>
                </div>


                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Alamat
                    </p>

                    <p class="text-gray-800 dark:text-gray-200">
                        {{ $setting->alamat ?: '-' }}
                    </p>
                </div>



                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Telepon / WhatsApp
                        </p>

                        <p class="text-gray-800 dark:text-gray-200">
                            {{ $setting->telepon ?: '-' }}
                        </p>
                    </div>


                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Email
                        </p>

                        <p class="text-gray-800 dark:text-gray-200">
                            {{ $setting->email ?: '-' }}
                        </p>
                    </div>


                </div>


            </div>


        </div>


    </div>

    {{-- Tentang Aplikasi --}}
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg p-6 md:p-8">


        <div class="flex items-center gap-3 mb-6">


            <div class="w-10 h-10 bg-[#0A2540] rounded-xl flex items-center justify-center text-white">

                <i class="fa-solid fa-circle-info"></i>

            </div>


            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                Tentang Aplikasi
            </h2>


        </div>



        <div class="space-y-4 text-gray-700 dark:text-gray-300">


            <div>
                <h3 class="text-2xl font-bold text-[#0A2540] dark:text-white">
                    POS ADITYA
                </h3>

                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Version 1.0.0
                </p>
            </div>
            <p>
                Aplikasi kasir berbasis web yang digunakan untuk membantu
                pengelolaan transaksi, produk, stok, dan laporan penjualan.
            </p>
            <div>
                <p class="font-semibold text-gray-800 dark:text-white mb-2">
                    Teknologi yang digunakan:
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="px-4 py-2 bg-gray-100 dark:bg-slate-700 rounded-xl">
                        Laravel 12
                    </span>
                    <span class="px-4 py-2 bg-gray-100 dark:bg-slate-700 rounded-xl">
                        Tailwind CSS
                    </span>
                    <span class="px-4 py-2 bg-gray-100 dark:bg-slate-700 rounded-xl">
                        MySQL
                    </span>
                    <span class="px-4 py-2 bg-gray-100 dark:bg-slate-700 rounded-xl">
                        Bootstrap
                    </span>
                </div>
            </div>
            <div class="border-t dark:border-slate-700 pt-4">
                <p>
                    Developer:
                    <span class="font-semibold">
                        Aditya Dwi Saputra
                    </span>
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                    © 2026 POS ADITYA.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection